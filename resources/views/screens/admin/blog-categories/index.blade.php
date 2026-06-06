@extends('layouts.admin.master')

@section('page_title', 'Blog Categories')

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
                        <h5>Blog Categories</h5>
                        <div class="card-header-right-icon">
                            <a href="{{ route('blog-categories.create') }}" class="btn btn-primary">
                                <i class="fa-solid fa-plus me-1"></i> Add Category
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0 common-option">
                    <div class="admin-list-table-wrap recent-table table-responsive custom-scrollbar">
                        <table class="table display" id="category-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Posts</th>
                                    <th>Status</th>
                                    <th>Sort</th>
                                    <th>Created</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $index => $category)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <a class="f-w-500" href="{{ route('blog-categories.edit', $category) }}">{{ $category->name }}</a>
                                                <span class="f-light f-12">{{ $category->slug }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $category->blogs_count }}</td>
                                        <td>
                                            @if ($category->status === 'active')
                                                <span class="badge badge-light-success">Active</span>
                                            @else
                                                <span class="badge badge-light-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->sort_order }}</td>
                                        <td>{{ $category->created_at->format('M d, Y') }}</td>
                                        <td class="text-end">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <a href="{{ route('blog-categories.edit', $category) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="fa-solid fa-pen"></i>
                                                </a>
                                                <button
                                                    type="button"
                                                    class="btn btn-sm btn-outline-danger delete-btn"
                                                    data-delete="{{ $category->blogs_count > 0 ? '0' : '1' }}"
                                                    data-url="{{ route('blog-categories.destroy', $category) }}"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <p class="mb-2 f-light">No categories yet.</p>
                                            <a href="{{ route('blog-categories.create') }}" class="btn btn-primary btn-sm">Create your first category</a>
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
            if ($('#category-table tbody tr td[colspan]').length === 0 && !$.fn.DataTable.isDataTable('#category-table')) {
                initAdminDataTable('#category-table', {
                    order: [[4, 'asc']],
                    columnDefs: [
                        { orderable: false, targets: [6] },
                    ],
                });
            }
        });
    </script>
@endpush
