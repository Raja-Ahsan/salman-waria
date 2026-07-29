<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_posts' => Blog::query()->count(),
            'published' => Blog::query()->where('status', 'published')->count(),
            'drafts' => Blog::query()->where('status', 'draft')->count(),
            'scheduled' => Blog::query()->where('status', 'scheduled')->count(),
            'categories' => BlogCategory::query()->count(),
            'active_categories' => BlogCategory::query()->where('status', 'active')->count(),
        ];

        $recentPosts = Blog::query()
            ->with(['category:id,name', 'author:id,name'])
            ->latest('updated_at')
            ->limit(8)
            ->get();

        $categories = BlogCategory::query()
            ->withCount('blogs')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('screens.admin.dashboard.index', compact('stats', 'recentPosts', 'categories'));
    }
}
