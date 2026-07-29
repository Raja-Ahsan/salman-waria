@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/quill-table-better@1.1.6/dist/quill-table-better.css" rel="stylesheet" />
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
        /* Full-width tables like Summernote */
        .blog-quill-editor .ql-editor .ql-table-wrapper,
        .blog-quill-editor .ql-editor table[class*="ql-table"],
        .blog-quill-editor .ql-editor table {
            width: 100% !important;
            max-width: 100% !important;
            border-collapse: collapse;
            table-layout: fixed;
            margin: 1em 0;
            display: table !important;
        }
        .blog-quill-editor .ql-editor table colgroup,
        .blog-quill-editor .ql-editor table col {
            width: auto !important;
        }
        .blog-quill-editor .ql-editor table td,
        .blog-quill-editor .ql-editor table th {
            border: 1px solid #ced4da;
            padding: 8px 10px;
            min-width: 0;
            width: auto !important;
            word-break: break-word;
            vertical-align: top;
        }
        .blog-quill-editor .ql-toolbar .ql-table-better {
            width: 28px;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quill-table-better@1.1.6/dist/quill-table-better.js"></script>
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
                if ($('#status').val() === 'draft') {
                    $('#status').val('published');
                }
                toggleScheduleField();
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

            if (typeof QuillTableBetter === 'undefined') {
                console.error('QuillTableBetter failed to load');
                return;
            }

            Quill.register({
                'modules/table-better': QuillTableBetter,
            }, true);

            const editorHost = document.getElementById('quill-editor');
            const contentField = document.getElementById('content');
            let initialContent = contentField ? contentField.value : '';

            if (initialContent) {
                initialContent = initialContent.replace(
                    /https?:\/\/[^"'>\s]+(\/storage\/)/g,
                    '$1'
                );
                // Editor-only nodes saved by mistake break table reload
                initialContent = initialContent
                    .replace(/<temporary\b[^>]*>[\s\S]*?<\/temporary>/gi, '')
                    .replace(/\sclass="ql-cell-focused"/gi, '')
                    .replace(/\sclass='ql-cell-focused'/gi, '');
            }

            editorHost.innerHTML = '';

            const quill = new Quill('#quill-editor', {
                theme: 'snow',
                modules: {
                    table: false,
                    toolbar: {
                        container: [
                            [{ header: [1, 2, 3, false] }],
                            ['bold', 'italic', 'underline', 'strike'],
                            [{ list: 'ordered' }, { list: 'bullet' }],
                            [{ indent: '-1' }, { indent: '+1' }],
                            ['link', 'image', 'video'],
                            ['blockquote', 'code-block'],
                            [{ align: [] }],
                            ['table-better'],
                            ['clean'],
                        ],
                        handlers: {
                            image: imageHandler,
                        },
                    },
                    'table-better': {
                        language: 'en_US',
                        menus: ['column', 'row', 'merge', 'table', 'cell', 'wrap', 'copy', 'delete'],
                        toolbarTable: true,
                    },
                    keyboard: {
                        bindings: QuillTableBetter.keyboardBindings,
                    },
                },
                placeholder: 'Write your blog content here...',
            });

            const tableModule = quill.getModule('table-better');

            // Official quill-table-better load path (setContents/dangerouslyPasteHTML strips tables)
            function loadEditorHtml(html) {
                if (!html || !String(html).trim()) {
                    return;
                }

                const delta = quill.clipboard.convert({ html: String(html) });
                quill.setContents([], Quill.sources.SILENT);
                quill.updateContents(delta, Quill.sources.SILENT);
                quill.setSelection(0, Quill.sources.SILENT);
                makeTablesFullWidth(quill.root);
                $('#content').val(
                    typeof quill.getSemanticHTML === 'function'
                        ? quill.getSemanticHTML()
                        : quill.root.innerHTML
                );
            }

            function syncContentField() {
                if (tableModule && typeof tableModule.deleteTableTemporary === 'function') {
                    tableModule.deleteTableTemporary(Quill.sources.SILENT);
                }
                if (tableModule && typeof tableModule.hideTools === 'function') {
                    tableModule.hideTools();
                }

                makeTablesFullWidth(quill.root);

                const html = typeof quill.getSemanticHTML === 'function'
                    ? quill.getSemanticHTML()
                    : quill.root.innerHTML;

                $('#content').val(html);
                return html;
            }

            if (initialContent && initialContent.trim() !== '') {
                loadEditorHtml(initialContent);
            }

            function makeTablesFullWidth(root) {
                if (root.dataset.normalizingTables === '1') {
                    return;
                }
                root.dataset.normalizingTables = '1';

                root.querySelectorAll('table').forEach(function (table) {
                    table.style.width = '100%';
                    table.style.maxWidth = '100%';
                    table.style.tableLayout = 'fixed';
                    table.removeAttribute('width');

                    const cols = table.querySelectorAll('col');
                    if (cols.length) {
                        const pct = (100 / cols.length).toFixed(4) + '%';
                        cols.forEach(function (col) {
                            col.setAttribute('width', pct);
                            col.style.width = pct;
                        });
                    }

                    table.querySelectorAll('td, th').forEach(function (cell) {
                        cell.removeAttribute('width');
                        cell.style.width = '';
                        cell.style.minWidth = '0';
                    });

                    const wrapper = table.closest('.ql-table-wrapper');
                    if (wrapper) {
                        wrapper.style.width = '100%';
                        wrapper.style.maxWidth = '100%';
                    }
                });

                root.dataset.normalizingTables = '0';
            }

            makeTablesFullWidth(quill.root);

            let tableNormalizeTimer = null;
            const tableObserver = new MutationObserver(function () {
                if (quill.root.dataset.normalizingTables === '1') {
                    return;
                }
                clearTimeout(tableNormalizeTimer);
                tableNormalizeTimer = setTimeout(function () {
                    makeTablesFullWidth(quill.root);
                }, 50);
            });
            tableObserver.observe(quill.root, {
                childList: true,
                subtree: true,
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

                syncContentField();
                Swal.close();
                return true;
            }

            let isProcessingSubmit = false;
            let lastClickedSubmitBtn = null;
            const formEl = document.getElementById('submit-form');

            $('#btn-save-draft, #btn-save-post').on('click', function() {
                lastClickedSubmitBtn = this;
            });

            formEl.addEventListener('submit', async function(e) {
                if (isProcessingSubmit) return;

                const hasBase64 = quill.root.querySelector('img[src^="data:"]');
                if (!hasBase64) {
                    syncContentField();
                    return;
                }

                e.preventDefault();
                e.stopImmediatePropagation();

                isProcessingSubmit = true;
                const ok = await replaceBase64ImagesBeforeSave();
                isProcessingSubmit = false;

                if (ok) {
                    formEl.requestSubmit(
                        lastClickedSubmitBtn || document.getElementById('btn-save-post')
                    );
                }
            }, true);

            quill.on('text-change', function() {
                formDirty = true;
                makeTablesFullWidth(quill.root);
                $('#content').val(
                    typeof quill.getSemanticHTML === 'function'
                        ? quill.getSemanticHTML()
                        : quill.root.innerHTML
                );
            });

            quill.root.querySelectorAll('img').forEach(function(img) {
                const src = img.getAttribute('src') || '';
                const fixed = src.replace(/^https?:\/\/[^/]+(\/storage\/)/, '$1');
                if (fixed !== src) {
                    img.setAttribute('src', fixed);
                }
            });

            $('#submit-form').on('submit', function() {
                formDirty = false;
                syncContentField();
            });

            const faqRowsEl = document.getElementById('faq-rows');
            let faqIndex = faqRowsEl ? faqRowsEl.querySelectorAll('.faq-row').length : 0;

            function renumberFaqRows() {
                if (!faqRowsEl) return;
                faqRowsEl.querySelectorAll('.faq-row').forEach(function (row, i) {
                    const num = row.querySelector('.faq-number');
                    if (num) num.textContent = String(i + 1);
                });
            }

            function bindRemoveFaqButtons() {
                if (!faqRowsEl) return;
                faqRowsEl.querySelectorAll('.remove-faq-row').forEach(function (btn) {
                    if (btn.dataset.bound === '1') return;
                    btn.dataset.bound = '1';
                    btn.addEventListener('click', function () {
                        const row = this.closest('.faq-row');
                        if (!row || !faqRowsEl) return;
                        if (faqRowsEl.querySelectorAll('.faq-row').length <= 1) {
                            row.querySelectorAll('input, textarea').forEach(function (el) {
                                el.value = '';
                            });
                            return;
                        }
                        row.remove();
                        renumberFaqRows();
                    });
                });
            }

            document.getElementById('add-faq-row')?.addEventListener('click', function () {
                if (!faqRowsEl) return;
                const row = document.createElement('div');
                row.className = 'faq-row border rounded p-3 mb-3';
                row.dataset.faqIndex = String(faqIndex);
                row.innerHTML = `
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <strong class="text-muted">FAQ #<span class="faq-number"></span></strong>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-faq-row" title="Remove FAQ">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Question</label>
                        <input type="text" class="form-control" name="faqs[${faqIndex}][question]" placeholder="Enter FAQ question" />
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Answer</label>
                        <textarea class="form-control" name="faqs[${faqIndex}][answer]" rows="3" placeholder="Enter FAQ answer"></textarea>
                    </div>
                `;
                faqRowsEl.appendChild(row);
                faqIndex += 1;
                renumberFaqRows();
                bindRemoveFaqButtons();
            });

            bindRemoveFaqButtons();
            renumberFaqRows();
        });
    </script>
@endpush
