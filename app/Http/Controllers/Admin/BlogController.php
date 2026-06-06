<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use App\Http\Requests\Admin\UploadBlogImageRequest;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Support\BlogContentProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::query()
            ->with(['author:id,name', 'category:id,name'])
            ->latest()
            ->get();

        return view('screens.admin.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('screens.admin.blogs.create', [
            'categories' => $this->activeCategories(),
        ]);
    }

    public function store(StoreBlogRequest $request): JsonResponse
    {
        [$data, $message, $downgraded] = $this->prepareBlogData($request->validated());
        $data['user_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blogs/featured', 'public');
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('blogs/og', 'public');
        }

        Blog::create($data);

        return response()->json([
            'success' => true,
            'message' => $message,
            'redirect' => route('blogs.index'),
            'downgraded_to_draft' => $downgraded,
        ]);
    }

    public function edit(Blog $blog): View
    {
        return view('screens.admin.blogs.edit', [
            'blog' => $blog,
            'categories' => $this->activeCategories($blog->blog_category_id),
        ]);
    }

    public function update(UpdateBlogRequest $request, Blog $blog): JsonResponse
    {
        [$data, $message, $downgraded] = $this->prepareBlogData($request->validated(), $blog);

        if ($request->boolean('remove_featured_image') && $blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
            $data['featured_image'] = null;
        }

        if ($request->boolean('remove_og_image') && $blog->og_image) {
            Storage::disk('public')->delete($blog->og_image);
            $data['og_image'] = null;
        }

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blogs/featured', 'public');
        }

        if ($request->hasFile('og_image')) {
            if ($blog->og_image) {
                Storage::disk('public')->delete($blog->og_image);
            }
            $data['og_image'] = $request->file('og_image')->store('blogs/og', 'public');
        }

        unset($data['remove_featured_image'], $data['remove_og_image']);

        $blog->update($data);

        return response()->json([
            'success' => true,
            'message' => $message,
            'redirect' => route('blogs.index'),
            'downgraded_to_draft' => $downgraded,
        ]);
    }

    public function destroy(Blog $blog): JsonResponse
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        if ($blog->og_image) {
            Storage::disk('public')->delete($blog->og_image);
        }

        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog post deleted successfully.',
        ]);
    }

    public function uploadImage(UploadBlogImageRequest $request): JsonResponse
    {
        $path = $request->file('image')->store('blogs/content', 'public');

        return response()->json([
            'success' => true,
            'url' => storage_public_url($path),
        ]);
    }

    /**
     * @return array{0: array<string, mixed>, 1: string, 2: bool}
     */
    private function prepareBlogData(array $validated, ?Blog $blog = null): array
    {
        $downgraded = false;
        $isDraftSave = ($validated['save_as'] ?? 'publish') === 'draft';

        $title = trim((string) ($validated['title'] ?? ''));
        if ($title === '') {
            $title = 'Untitled Draft';
        }

        $slug = trim((string) ($validated['slug'] ?? ''));
        if ($slug === '') {
            $slug = Blog::uniqueSlug($title, $blog?->id);
        }

        $content = BlogContentProcessor::process($validated['content'] ?? null);
        $content = normalize_storage_urls($content);
        $status = $isDraftSave ? 'draft' : ($validated['status'] ?? 'draft');
        $scheduledAt = null;
        $publishedAt = null;

        if ($isDraftSave) {
            $status = 'draft';
        } elseif (in_array($status, ['published', 'scheduled'], true) && Blog::isContentEmpty($content)) {
            $status = 'draft';
            $downgraded = true;
        } elseif ($status === 'scheduled') {
            $scheduledAt = isset($validated['scheduled_at'])
                ? Carbon::parse($validated['scheduled_at'])
                : null;

            if (! $scheduledAt) {
                $status = 'draft';
                $downgraded = true;
            } elseif ($scheduledAt->isPast()) {
                $status = 'published';
                $publishedAt = $scheduledAt;
                $scheduledAt = null;
            }
        } elseif ($status === 'published') {
            $publishedAt = $blog?->published_at ?? now();
        }

        if ($status === 'draft') {
            $publishedAt = null;
            $scheduledAt = null;
        }

        if ($status === 'published') {
            $scheduledAt = null;
        }

        if ($status === 'scheduled') {
            $publishedAt = null;
        }

        $message = match (true) {
            $downgraded => 'Post saved as draft because it is incomplete or not ready to publish.',
            $isDraftSave => 'Draft saved successfully.',
            $status === 'scheduled' => 'Blog post scheduled successfully.',
            $status === 'published' => $blog
                ? 'Blog post updated and published successfully.'
                : 'Blog post created and published successfully.',
            default => $blog
                ? 'Blog post updated successfully.'
                : 'Blog post created successfully.',
        };

        return [
            [
                'title' => $title,
                'slug' => $slug,
                'content' => $content,
                'status' => $status,
                'published_at' => $publishedAt,
                'scheduled_at' => $scheduledAt,
                'meta_title' => $validated['meta_title'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'canonical_url' => $validated['canonical_url'] ?? null,
                'robots' => $validated['robots'] ?? 'index, follow',
                'blog_category_id' => $validated['blog_category_id'] ?? null,
            ],
            $message,
            $downgraded,
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<int, BlogCategory>
     */
    private function activeCategories(?int $includeId = null): \Illuminate\Database\Eloquent\Collection
    {
        return BlogCategory::query()
            ->where(function ($q) use ($includeId) {
                $q->where('status', 'active');
                if ($includeId) {
                    $q->orWhere('id', $includeId);
                }
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }
}
