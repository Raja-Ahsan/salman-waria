@extends('layouts.admin.master')

@section('page_title', 'All Posts')

@section('breadcrumb')
    <li class="breadcrumb-item">Blogs</li>
@endsection

@section('content')
    @include('includes.admin.datatable-list')

    <div class="row">
        <div class="col-12">
            <div class="card admin-list-card">
                <div class="card-header card-no-border">
                    <div class="header-top">
                        <h5>Blog Posts</h5>
                        <div class="card-header-right-icon">
                            <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus me-1"></i> Add Post
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 common-option">
                    <div class="admin-list-table-wrap recent-table table-responsive custom-scrollbar">
                        <table class="table display" id="blog-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Author</th>
                                    <th>Publish / Schedule</th>
                                    <th>Created</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($blogs as $index => $blog)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a class="f-w-500" href="{{ route('blogs.edit', $blog) }}">{{ $blog->title }}</a>
                                                <span class="f-light f-12">{{ $blog->slug }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $blog->category?->name ?? '—' }}</td>
                                        <td>
                                            @if ($blog->status === 'published')
                                                <span class="badge badge-light-success">Published</span>
                                            @elseif ($blog->status === 'scheduled')
                                                <span class="badge badge-light-info">Scheduled</span>
                                            @else
                                                <span class="badge badge-light-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td>{{ $blog->author?->name ?? '—' }}</td>
                                        <td>
                                            @if ($blog->status === 'scheduled' && $blog->scheduled_at)
                                                <span class="f-light">{{ $blog->scheduled_at->format('M d, Y h:i A') }}</span>
                                            @elseif ($blog->published_at)
                                                {{ $blog->published_at->format('M d, Y h:i A') }}
                                            @else
                                                —
                                            @endif
                                        </td>
                                        <td>{{ $blog->created_at->format('M d, Y') }}</td>
                                        <td class="text-end">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-danger delete-btn"
                                                    data-delete="1"
                                                    data-url="{{ route('blogs.destroy', $blog) }}"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
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
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            if ($('#blog-table tbody tr td[colspan]').length === 0 && !$.fn.DataTable.isDataTable('#blog-table')) {
                initAdminDataTable('#blog-table', {
                    order: [[6, 'desc']],
                    columnDefs: [
                        { orderable: false, targets: [7] },
                    ],
                });
            }
        });
    </script>
@endpush
