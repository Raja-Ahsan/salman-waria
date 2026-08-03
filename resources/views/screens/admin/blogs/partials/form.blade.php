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
                        <div id="quill-editor" class="blog-quill-editor"></div>
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

            <div class="card">
                <div class="card-header">
                    <h5>Schema Markup (JSON-LD)</h5>
                </div>
                <div class="card-body">
                    <div class="mb-0">
                        <label class="form-label" for="custom_schema">Custom Schema</label>
                        <textarea
                            class="form-control font-monospace"
                            id="custom_schema"
                            name="custom_schema"
                            rows="8"
                            placeholder='{"@@context":"https://schema.org","@@type":"Article","headline":"..."}'>{{ old('custom_schema', isset($blog) ? ($blog->custom_schema ?? '') : '') }}</textarea>
                        <small class="text-muted d-block mt-2">
                            Optional. Paste JSON-LD object, array of schemas, or a full
                            <code>&lt;script type="application/ld+json"&gt;...&lt;/script&gt;</code> block.
                            BlogPosting schema is added automatically; use this for extra schemas (e.g. FAQPage).
                        </small>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">FAQs</h5>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-faq-row">
                        <i class="fa fa-plus me-1"></i> Add FAQ
                    </button>
                </div>
                <div class="card-body">
                    @php
                        $faqRows = old('faqs', isset($blog) ? ($blog->faqs ?? []) : []);
                        if (! is_array($faqRows) || $faqRows === []) {
                            $faqRows = [['question' => '', 'answer' => '']];
                        }
                    @endphp
                    <div id="faq-rows">
                        @foreach ($faqRows as $index => $faq)
                            <div class="faq-row border rounded p-3 mb-3" data-faq-index="{{ $index }}">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <strong class="text-muted">FAQ #<span class="faq-number">{{ $loop->iteration }}</span></strong>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-faq-row" title="Remove FAQ">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="faq-question-{{ $index }}">Question</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="faq-question-{{ $index }}"
                                        name="faqs[{{ $index }}][question]"
                                        value="{{ $faq['question'] ?? '' }}"
                                        placeholder="Enter FAQ question" />
                                </div>
                                <div class="mb-0">
                                    <label class="form-label" for="faq-answer-{{ $index }}">Answer</label>
                                    <textarea
                                        class="form-control"
                                        id="faq-answer-{{ $index }}"
                                        name="faqs[{{ $index }}][answer]"
                                        rows="3"
                                        placeholder="Enter FAQ answer">{{ $faq['answer'] ?? '' }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <small class="text-muted">Optional. FAQs appear on the blog detail page and generate FAQPage schema when saved.</small>
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
                        <small class="text-muted">Post will auto-publish at this time ({{ config('app.timezone') }}).</small>
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
