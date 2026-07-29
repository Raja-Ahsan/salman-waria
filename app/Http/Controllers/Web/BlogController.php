<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Support\SchemaMarkup;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        [$posts, $categories, $activeCategory] = $this->blogListingData($request);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'html' => view('screens.web.blogs.partials.posts', compact('posts'))->render(),
                'category' => $activeCategory?->slug,
            ]);
        }

        $custom_schema = SchemaMarkup::script([
            '@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => 'Salman Waria Blog',
            'url' => route('blog.index'),
            'description' => 'Insights on AI, entrepreneurship, technology, and the future from Salman Waria.',
            'author' => [
                '@type' => 'Person',
                'name' => 'Salman Waria',
            ],
        ]);

        return view('screens.web.blogs.index', compact(
            'posts',
            'categories',
            'activeCategory',
            'custom_schema',
        ));
    }

    public function show(string $slug): View
    {
        $post = Blog::query()
            ->published()
            ->with(['category:id,name,slug', 'author:id,name'])
            ->where('slug', $slug)
            ->firstOrFail();

        $metaTitle = $post->meta_title ?: $post->title;
        $metaDescription = $post->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($post->content ?? ''), 160);

        $custom_schema = SchemaMarkup::script([
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => $metaDescription,
            'datePublished' => $post->published_at?->toIso8601String(),
            'dateModified' => $post->updated_at->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => $post->author?->name ?? 'Salman Waria',
            ],
            'url' => route('blog.show', $post->slug),
            'mainEntityOfPage' => route('blog.show', $post->slug),
        ]);

        $blog_schema = $post->customSchemaMarkup();
        $faq_schema = $post->faqSchemaMarkup();

        $related = Blog::query()
            ->published()
            ->with('category:id,name,slug')
            ->where('id', '!=', $post->id)
            ->when($post->blog_category_id, fn ($q) => $q->where('blog_category_id', $post->blog_category_id))
            ->latest('published_at')
            ->limit(3)
            ->get();

        return view('screens.web.blogs.show', compact(
            'post',
            'metaTitle',
            'metaDescription',
            'custom_schema',
            'blog_schema',
            'faq_schema',
            'related',
        ));
    }

    /**
     * @return array{0: \Illuminate\Contracts\Pagination\LengthAwarePaginator, 1: \Illuminate\Database\Eloquent\Collection, 2: ?BlogCategory}
     */
    private function blogListingData(Request $request): array
    {
        $categorySlug = $request->query('category');
        $activeCategory = null;

        if (is_string($categorySlug) && $categorySlug !== '') {
            $activeCategory = BlogCategory::query()
                ->where('slug', $categorySlug)
                ->where('status', 'active')
                ->first();
        }

        $posts = Blog::query()
            ->published()
            ->with(['category:id,name,slug', 'author:id,name'])
            ->when($activeCategory, fn ($q) => $q->where('blog_category_id', $activeCategory->id))
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        $categories = BlogCategory::query()
            ->where('status', 'active')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get(['id', 'name', 'slug']);

        return [$posts, $categories, $activeCategory];
    }
}
