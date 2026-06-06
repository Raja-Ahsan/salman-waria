@php
    $isEdit = isset($blog);
    $formAction = $isEdit ? route('blogs.update', $blog) : route('blogs.store');
    $formMethod = $isEdit ? 'POST' : 'POST';
@endphp

<form id="submit-form" action="{{ $formAction }}" method="{{ $formMethod }}" enctype="multipart/form-data">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5>Post Content</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            name="title"
                            value="{{ old('title', $blog->title ?? '') }}"
                            placeholder="Enter blog title"
                            required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="slug">Slug</label>
                        <input
                            type="text"
                            class="form-control"
                            id="slug"
                            name="slug"
                            value="{{ old('slug', $blog->slug ?? '') }}"
                            placeholder="auto-generated-from-title"
                            data-manual="{{ $isEdit ? '1' : '0' }}" />
                        <small class="text-muted">Leave empty to auto-generate from title.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <div id="quill-editor" class="blog-quill-editor">{!! normalize_storage_urls(old('content', $blog->content ?? '')) !!}</div>
                        <textarea name="content" id="content" class="d-none">{{ old('content', $blog->content ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>SEO Settings</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="meta_title">Meta Title</label>
                        <input
                            type="text"
                            class="form-control"
                            id="meta_title"
                            name="meta_title"
                            value="{{ old('meta_title', $blog->meta_title ?? '') }}"
                            placeholder="SEO title (defaults to post title if empty)" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="meta_description">Meta Description</label>
                        <textarea
                            class="form-control"
                            id="meta_description"
                            name="meta_description"
                            rows="3"
                            placeholder="Brief description for search engines (max 500 chars)">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="meta_keywords">Meta Keywords</label>
                        <input
                            type="text"
                            class="form-control"
                            id="meta_keywords"
                            name="meta_keywords"
                            value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}"
                            placeholder="keyword one, keyword two, keyword three" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="canonical_url">Canonical URL</label>
                        <input
                            type="url"
                            class="form-control"
                            id="canonical_url"
                            name="canonical_url"
                            value="{{ old('canonical_url', $blog->canonical_url ?? '') }}"
                            placeholder="https://example.com/blog/post-slug" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="robots">Robots</label>
                        <select class="form-select" id="robots" name="robots">
                            @foreach (['index, follow', 'index, nofollow', 'noindex, follow', 'noindex, nofollow'] as $robotsOption)
                                <option value="{{ $robotsOption }}" @selected(old('robots', $blog->robots ?? 'index, follow') === $robotsOption)>
                                    {{ $robotsOption }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-0">
                        <label class="form-label" for="og_image">OG Image (Social Share)</label>
                        <input type="file" class="form-control" id="og_image" name="og_image" accept="image/*" />
                        @if ($isEdit && $blog->og_image)
                            <div class="mt-2 d-flex align-items-center gap-3">
                                <img src="{{ storage_public_url($blog->og_image) }}" alt="OG image" class="img-thumbnail" style="max-height: 80px;" />
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remove_og_image" value="1" id="remove_og_image" />
                                    <label class="form-check-label" for="remove_og_image">Remove OG image</label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header">
                    <h5>Publish</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label" for="blog_category_id">Category</label>
                        <select class="form-select" id="blog_category_id" name="blog_category_id">
                            <option value="">— No category —</option>
                            @foreach ($categories ?? [] as $category)
                                <option
                                    value="{{ $category->id }}"
                                    @selected((string) old('blog_category_id', $blog->blog_category_id ?? '') === (string) $category->id)>
                                    {{ $category->name }}
                                    @if ($category->status === 'inactive')
                                        (Inactive)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">
                            <a href="{{ route('blog-categories.create') }}" target="_blank">Add new category</a>
                        </small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="draft" @selected(old('status', $blog->status ?? 'draft') === 'draft')>Draft</option>
                            <option value="published" @selected(old('status', $blog->status ?? '') === 'published')>Publish Now</option>
                            <option value="scheduled" @selected(old('status', $blog->status ?? '') === 'scheduled')>Schedule</option>
                        </select>
                    </div>

                    <div class="mb-3 schedule-field {{ old('status', $blog->status ?? 'draft') === 'scheduled' ? '' : 'd-none' }}">
                        <label class="form-label" for="scheduled_at">Schedule Date & Time <span class="text-danger">*</span></label>
                        <input
                            type="datetime-local"
                            class="form-control"
                            id="scheduled_at"
                            name="scheduled_at"
                            value="{{ old('scheduled_at', isset($blog) && $blog->scheduled_at ? $blog->scheduled_at->format('Y-m-d\TH:i') : '') }}" />
                        <small class="text-muted">Post will auto-publish at this time.</small>
                    </div>

                    @if ($isEdit && $blog->published_at)
                        <p class="f-light mb-3">
                            <i class="fa-regular fa-clock me-1"></i>
                            Published: {{ $blog->published_at->format('M d, Y h:i A') }}
                        </p>
                    @endif

                    @if ($isEdit && $blog->status === 'scheduled' && $blog->scheduled_at)
                        <p class="f-light mb-3">
                            <i class="fa-regular fa-calendar me-1"></i>
                            Scheduled: {{ $blog->scheduled_at->format('M d, Y h:i A') }}
                        </p>
                    @endif

                    <input type="hidden" name="save_as" id="save_as" value="publish" />

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" id="btn-save-post">
                            {{ $isEdit ? 'Update Post' : 'Save Post' }}
                        </button>
                        <button type="submit" class="btn btn-outline-secondary" id="btn-save-draft">
                            <i class="fa-regular fa-floppy-disk me-1"></i> Save as Draft
                        </button>
                        <a href="{{ route('blogs.index') }}" class="btn btn-light" id="btn-cancel">Cancel</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Main Image</h5>
                </div>
                <div class="card-body">
                    <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*" />
                    <small class="text-muted d-block mt-2">Shows on blog listing cards and below the title on the post page.</small>
                    @if ($isEdit && $blog->featured_image)
                        <div class="mt-3">
                            <img src="{{ storage_public_url($blog->featured_image) }}" alt="Main image preview" class="img-fluid rounded" />
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="remove_featured_image" value="1" id="remove_featured_image" />
                                <label class="form-check-label" for="remove_featured_image">Remove main image</label>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <style>
        .blog-quill-editor {
            min-height: 320px;
            background: #fff;
        }
        .blog-quill-editor .ql-editor {
            min-height: 280px;
            font-size: 15px;
            line-height: 1.6;
        }
        .blog-quill-editor .ql-editor img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        $(document).ready(function() {
            const uploadUrl = @json(route('blogs.upload-image'));
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            let slugManual = $('#slug').data('manual') == 1;

            function slugify(text) {
                return text.toString().toLowerCase()
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
            }

            $('#title').on('input', function() {
                if (!slugManual) {
                    $('#slug').val(slugify($(this).val()));
                }
            });

            $('#slug').on('input', function() {
                slugManual = $(this).val().length > 0;
                $(this).data('manual', slugManual ? 1 : 0);
            });

            function toggleScheduleField() {
                const isScheduled = $('#status').val() === 'scheduled';
                $('.schedule-field').toggleClass('d-none', !isScheduled);
                $('#scheduled_at').prop('required', isScheduled && $('#save_as').val() !== 'draft');
            }

            $('#status').on('change', toggleScheduleField);
            toggleScheduleField();

            $('#btn-save-draft').on('click', function() {
                $('#save_as').val('draft');
                $('#status').val('draft');
                toggleScheduleField();
            });

            $('#btn-save-post').on('click', function() {
                $('#save_as').val('publish');
            });

            let formDirty = false;
            $('#submit-form').on('input change', 'input, select, textarea', function() {
                formDirty = true;
            });

            window.addEventListener('beforeunload', function(e) {
                if (formDirty) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            $('#btn-cancel').on('click', function() {
                formDirty = false;
            });

            async function uploadImageFile(file, quillInstance, insertIndex) {
                if (!file || !file.type.startsWith('image/')) {
                    return false;
                }

                if (file.size > 5 * 1024 * 1024) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Image too large',
                        text: 'Each image must be 5 MB or smaller.',
                    });
                    return false;
                }

                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', csrfToken);

                const response = await fetch(uploadUrl, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                });

                const data = await response.json();

                if (!response.ok || !data.success) {
                    throw new Error(data.message || 'Image upload failed.');
                }

                const index = insertIndex ?? quillInstance.getSelection(true)?.index ?? quillInstance.getLength();
                quillInstance.insertEmbed(index, 'image', data.url);
                quillInstance.setSelection(index + 1);

                return true;
            }

            function imageHandler() {
                const input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();

                input.onchange = async () => {
                    const file = input.files[0];
                    if (!file) return;

                    try {
                        await uploadImageFile(file, quill, quill.getSelection(true)?.index);
                    } catch (err) {
                        Swal.fire({
                            icon: 'error',
                            title: err.message || 'Could not upload image.',
                        });
                    }
                };
            }

            const quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    toolbar: {
                        container: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            [{ indent: '-1' }, { indent: '+1' }],
                            ['link', 'image', 'video'],
                            ['blockquote', 'code-block'],
                            [{ align: [] }],
                            ['clean'],
                        ],
                        handlers: {
                            image: imageHandler,
                        },
                    },
                },
                placeholder: 'Write your blog content here...',
            });

            quill.root.addEventListener('paste', async function(e) {
                const items = e.clipboardData?.items;
                if (!items) return;

                for (const item of items) {
                    if (item.type.startsWith('image/')) {
                        e.preventDefault();
                        e.stopPropagation();

                        const file = item.getAsFile();
                        if (!file) continue;

                        try {
                            Swal.fire({
                                icon: 'info',
                                title: 'Uploading image…',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading(),
                            });
                            await uploadImageFile(file, quill, quill.getSelection(true)?.index);
                            Swal.close();
                        } catch (err) {
                            Swal.fire({
                                icon: 'error',
                                title: err.message || 'Could not upload image.',
                            });
                        }
                        return;
                    }
                }
            }, true);

            quill.root.addEventListener('drop', async function(e) {
                const files = e.dataTransfer?.files;
                if (!files || !files.length) return;

                const imageFile = Array.from(files).find(f => f.type.startsWith('image/'));
                if (!imageFile) return;

                e.preventDefault();
                e.stopPropagation();

                try {
                    await uploadImageFile(imageFile, quill, quill.getSelection(true)?.index);
                } catch (err) {
                    Swal.fire({
                        icon: 'error',
                        title: err.message || 'Could not upload image.',
                    });
                }
            });

            async function replaceBase64ImagesBeforeSave() {
                const images = quill.root.querySelectorAll('img[src^="data:"]');
                if (!images.length) return true;

                Swal.fire({
                    icon: 'info',
                    title: 'Uploading embedded images…',
                    text: 'Please wait while images are saved to the server.',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading(),
                });

                for (const img of images) {
                    const src = img.getAttribute('src');
                    if (!src || !src.startsWith('data:')) continue;

                    try {
                        const blob = await fetch(src).then(r => r.blob());
                        const file = new File([blob], 'embedded-image.png', { type: blob.type });
                        const formData = new FormData();
                        formData.append('image', file);
                        formData.append('_token', csrfToken);

                        const response = await fetch(uploadUrl, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json',
                            },
                        });

                        const data = await response.json();
                        if (!response.ok || !data.success) {
                            throw new Error(data.message || 'Image upload failed.');
                        }

                        img.setAttribute('src', data.url);
                    } catch (err) {
                        Swal.fire({
                            icon: 'error',
                            title: err.message || 'Could not upload an embedded image.',
                        });
                        return false;
                    }
                }

                $('#content').val(quill.root.innerHTML);
                Swal.close();
                return true;
            }

            let isProcessingSubmit = false;
            const formEl = document.getElementById('submit-form');

            formEl.addEventListener('submit', async function(e) {
                if (isProcessingSubmit) return;

                const hasBase64 = quill.root.querySelector('img[src^="data:"]');
                if (!hasBase64) {
                    $('#content').val(quill.root.innerHTML);
                    return;
                }

                e.preventDefault();
                e.stopImmediatePropagation();

                isProcessingSubmit = true;
                const ok = await replaceBase64ImagesBeforeSave();
                isProcessingSubmit = false;

                if (ok) {
                    $(formEl).trigger('submit');
                }
            }, true);

            quill.on('text-change', function() {
                formDirty = true;
                $('#content').val(quill.root.innerHTML);
            });

            quill.root.querySelectorAll('img').forEach(function(img) {
                const src = img.getAttribute('src') || '';
                const fixed = src.replace(/^https?:\/\/[^/]+(\/storage\/)/, '$1');
                if (fixed !== src) {
                    img.setAttribute('src', fixed);
                }
            });
            $('#content').val(quill.root.innerHTML);

            $('#submit-form').on('submit', function() {
                formDirty = false;
                $('#content').val(quill.root.innerHTML);
            });
        });
    </script>
@endpush
