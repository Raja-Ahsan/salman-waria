@php
    $isEdit = isset($blogCategory);
    $formAction = $isEdit ? route('blog-categories.update', $blogCategory) : route('blog-categories.store');
@endphp

<form id="submit-form" action="{{ $formAction }}" method="POST">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5>Category Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            value="{{ old('name', $blogCategory->name ?? '') }}"
                            placeholder="e.g. Technology, Business"
                            required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="slug">Slug</label>
                        <input
                            type="text"
                            class="form-control"
                            id="slug"
                            name="slug"
                            value="{{ old('slug', $blogCategory->slug ?? '') }}"
                            placeholder="auto-generated-from-name"
                            data-manual="{{ $isEdit ? '1' : '0' }}" />
                        <small class="text-muted">Leave empty to auto-generate from name.</small>
                    </div>

                    <div class="mb-0">
                        <label class="form-label" for="description">Description</label>
                        <textarea
                            class="form-control"
                            id="description"
                            name="description"
                            rows="4"
                            placeholder="Optional short description">{{ old('description', $blogCategory->description ?? '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active" @selected(old('status', $blogCategory->status ?? 'active') === 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $blogCategory->status ?? '') === 'inactive')>Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="sort_order">Sort Order</label>
                        <input
                            type="number"
                            class="form-control"
                            id="sort_order"
                            name="sort_order"
                            min="0"
                            max="9999"
                            value="{{ old('sort_order', $blogCategory->sort_order ?? 0) }}" />
                        <small class="text-muted">Lower numbers appear first.</small>
                    </div>

                    @if ($isEdit)
                        <p class="f-light mb-3">
                            <i class="fa-solid fa-file-lines me-1"></i>
                            {{ $blogCategory->blogs_count ?? $blogCategory->blogs()->count() }} post(s) in this category
                        </p>
                    @endif

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ $isEdit ? 'Update Category' : 'Create Category' }}
                        </button>
                        <a href="{{ route('blog-categories.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function() {
            let slugManual = $('#slug').data('manual') == 1;

            function slugify(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
            }

            $('#name').on('input', function() {
                if (!slugManual) {
                    $('#slug').val(slugify($(this).val()));
                }
            });

            $('#slug').on('input', function() {
                slugManual = $(this).val().length > 0;
                $(this).data('manual', slugManual ? 1 : 0);
            });
        });
    </script>
@endpush
