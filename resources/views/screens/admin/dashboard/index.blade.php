@extends('layouts.admin.master')

@section('page_title', 'Dashboard')

@section('content')
    <div class="row g-3 mb-3">
        <div class="col-12">
            <div class="card admin-dashboard-welcome">
                <div class="card-body d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <h4 class="f-w-600 mb-1">Welcome, {{ auth()->user()->name ?? 'Admin' }}!</h4>
                        <p class="f-light mb-0">Manage blog posts, categories, and published content for Salman Waria.</p>
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                            <i class="fa-solid fa-plus me-1"></i> New Post
                        </a>
                        <a href="{{ route('blog-categories.create') }}" class="btn btn-outline-primary">
                            <i class="fa-solid fa-folder-plus me-1"></i> New Category
                        </a>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary" target="_blank" rel="noopener noreferrer">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> View Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row widget-grid g-3">
        <div class="col-xl-3 col-sm-6">
            <div class="card widget-1 h-100">
                <div class="card-body">
                    <div class="widget-content">
                        <div class="widget-round primary">
                            <div class="bg-round">
                                <i class="fa-solid fa-newspaper"></i>
                            </div>
                        </div>
                        <div>
                            <h4>{{ $stats['total_posts'] }}</h4>
                            <span class="f-light">Total Posts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card widget-1 h-100">
                <div class="card-body">
                    <div class="widget-content">
                        <div class="widget-round success">
                            <div class="bg-round">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                        </div>
                        <div>
                            <h4>{{ $stats['published'] }}</h4>
                            <span class="f-light">Published</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card widget-1 h-100">
                <div class="card-body">
                    <div class="widget-content">
                        <div class="widget-round warning">
                            <div class="bg-round">
                                <i class="fa-solid fa-file-pen"></i>
                            </div>
                        </div>
                        <div>
                            <h4>{{ $stats['drafts'] }}</h4>
                            <span class="f-light">Drafts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card widget-1 h-100">
                <div class="card-body">
                    <div class="widget-content">
                        <div class="widget-round secondary">
                            <div class="bg-round">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                        </div>
                        <div>
                            <h4>{{ $stats['scheduled'] }}</h4>
                            <span class="f-light">Scheduled</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-xl-4 col-md-6">
            <div class="card widget-1 h-100">
                <div class="card-body">
                    <div class="widget-content">
                        <div class="widget-round primary">
                            <div class="bg-round">
                                <i class="fa-solid fa-folder-tree"></i>
                            </div>
                        </div>
                        <div>
                            <h4>{{ $stats['categories'] }}</h4>
                            <span class="f-light">Categories</span>
                        </div>
                    </div>
                    <p class="f-light f-12 mb-0 mt-3">{{ $stats['active_categories'] }} active · {{ $stats['categories'] - $stats['active_categories'] }} inactive</p>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-md-6">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="f-w-600 mb-3">Quick Links</h6>
                    <div class="row g-2">
                        <div class="col-sm-6">
                            <a href="{{ route('blogs.index') }}" class="admin-dash-link">
                                <i class="fa-solid fa-list-ul"></i>
                                <span>
                                    <strong>All Posts</strong>
                                    <small>View and edit every blog post</small>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('blog-categories.index') }}" class="admin-dash-link">
                                <i class="fa-solid fa-tags"></i>
                                <span>
                                    <strong>Categories</strong>
                                    <small>Organize posts by topic</small>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('blogs.create') }}" class="admin-dash-link">
                                <i class="fa-solid fa-pen-nib"></i>
                                <span>
                                    <strong>Write Post</strong>
                                    <small>Create a new blog article</small>
                                </span>
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <a href="{{ route('blog.index') }}" class="admin-dash-link" target="_blank" rel="noopener noreferrer">
                                <i class="fa-solid fa-globe"></i>
                                <span>
                                    <strong>Public Blog</strong>
                                    <small>See how posts look on the site</small>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-xl-8">
            <div class="card admin-list-card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <h5>Recent Posts</h5>
                        <div class="card-header-right-icon">
                            <a href="{{ route('blogs.index') }}" class="btn btn-sm btn-outline-primary">View all</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="admin-list-table-wrap table-responsive custom-scrollbar">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Updated</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentPosts as $post)
                                    <tr>
                                        <td>
                                            <a class="f-w-500" href="{{ route('blogs.edit', $post) }}">{{ $post->title }}</a>
                                            <div class="f-light f-12">{{ $post->slug }}</div>
                                        </td>
                                        <td>{{ $post->category?->name ?? '—' }}</td>
                                        <td>
                                            @if ($post->status === 'published')
                                                <span class="badge badge-light-success">Published</span>
                                            @elseif ($post->status === 'scheduled')
                                                <span class="badge badge-light-info">Scheduled</span>
                                            @else
                                                <span class="badge badge-light-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td class="f-light">{{ $post->updated_at->format('M d, Y') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('blogs.edit', $post) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <p class="mb-2 f-light">No blog posts yet.</p>
                                            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm">Create your first post</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card admin-list-card h-100">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <h5>Categories</h5>
                        <div class="card-header-right-icon">
                            <a href="{{ route('blog-categories.index') }}" class="btn btn-sm btn-outline-primary">Manage</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="admin-list-table-wrap table-responsive custom-scrollbar">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr>
                                        <td>
                                            <a class="f-w-500" href="{{ route('blog-categories.edit', $category) }}">{{ $category->name }}</a>
                                        </td>
                                        <td>{{ $category->blogs_count }}</td>
                                        <td>
                                            @if ($category->status === 'active')
                                                <span class="badge badge-light-success">Active</span>
                                            @else
                                                <span class="badge badge-light-secondary">Inactive</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">
                                            <p class="mb-2 f-light">No categories yet.</p>
                                            <a href="{{ route('blog-categories.create') }}" class="btn btn-primary btn-sm">Add category</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .admin-dashboard-welcome {
        border: 1px solid rgba(115, 102, 255, 0.12);
        background: linear-gradient(135deg, rgba(115, 102, 255, 0.08), rgba(201, 168, 76, 0.06));
    }

    .widget-1 .widget-round .bg-round i {
        font-size: 1.35rem;
        line-height: 1;
        position: relative;
        z-index: 2;
    }

    .widget-1 .widget-round.primary .bg-round i {
        color: #7366ff;
    }

    .widget-1 .widget-round.success .bg-round i {
        color: #54ba4a;
    }

    .widget-1 .widget-round.warning .bg-round i {
        color: #ffb829;
    }

    .widget-1 .widget-round.secondary .bg-round i {
        color: #6c757d;
    }

    .admin-dash-link {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 14px 16px;
        border: 1px solid rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        height: 100%;
        transition: border-color 0.2s ease, background 0.2s ease;
    }

    .admin-dash-link:hover {
        border-color: rgba(115, 102, 255, 0.35);
        background: rgba(115, 102, 255, 0.04);
        color: inherit;
    }

    .admin-dash-link i {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(115, 102, 255, 0.12);
        color: #7366ff;
        flex-shrink: 0;
    }

    .admin-dash-link span {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .admin-dash-link strong {
        font-size: 0.92rem;
    }

    .admin-dash-link small {
        color: #8996a4;
        font-size: 0.78rem;
    }
</style>
@endpush
