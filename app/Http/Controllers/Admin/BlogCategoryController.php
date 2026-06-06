<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogCategoryFormRequest;
use App\Models\BlogCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BlogCategory::query()
            ->withCount('blogs')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('screens.admin.blog-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('screens.admin.blog-categories.create');
    }

    public function store(BlogCategoryFormRequest $request): JsonResponse
    {
        BlogCategory::create($this->prepareData($request->validated()));

        return response()->json([
            'success' => true,
            'message' => 'Blog category created successfully.',
            'redirect' => route('blog-categories.index'),
        ]);
    }

    public function edit(BlogCategory $blogCategory): View
    {
        $blogCategory->loadCount('blogs');

        return view('screens.admin.blog-categories.edit', compact('blogCategory'));
    }

    public function update(BlogCategoryFormRequest $request, BlogCategory $blogCategory): JsonResponse
    {
        $blogCategory->update($this->prepareData($request->validated(), $blogCategory));

        return response()->json([
            'success' => true,
            'message' => 'Blog category updated successfully.',
            'redirect' => route('blog-categories.index'),
        ]);
    }

    public function destroy(BlogCategory $blogCategory): JsonResponse
    {
        if ($blogCategory->blogs()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete category while posts are assigned to it.',
            ], 422);
        }

        $blogCategory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog category deleted successfully.',
        ]);
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function prepareData(array $validated, ?BlogCategory $category = null): array
    {
        $slug = trim((string) ($validated['slug'] ?? ''));
        if ($slug === '') {
            $slug = BlogCategory::uniqueSlug($validated['name'], $category?->id);
        }

        return [
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ];
    }
}
