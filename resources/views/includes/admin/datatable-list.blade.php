{{-- Shared Cuba-style list table layout + DataTables defaults --}}
@push('styles')
    <style>
        .admin-list-card .card-body.common-option {
            padding: 0;
        }

        .admin-list-card .admin-list-table-wrap {
            padding: 0 1.25rem 1.25rem;
        }

        .admin-list-card .dt-container {
            padding-top: 0.5rem;
        }

        .admin-list-card .dt-container .row.mt-2 {
            align-items: center;
            margin-bottom: 1rem !important;
        }

        .admin-list-card .dt-search input,
        .admin-list-card .dt-length select {
            min-height: 38px;
        }

        .admin-list-card table.table.dataTable {
            width: 100% !important;
        }

        .admin-list-card table.table.dataTable thead th {
            font-weight: 600;
            white-space: nowrap;
        }

        .admin-list-card .dt-paging .pagination {
            margin-bottom: 0;
        }
    </style>
@endpush

@push('scripts')
    <script>
        window.initAdminDataTable = function(selector, options) {
            const defaults = {
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                autoWidth: false,
                responsive: true,
                language: {
                    search: '',
                    searchPlaceholder: 'Search…',
                    lengthMenu: 'Show _MENU_ entries',
                    info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                    paginate: {
                        first: '«',
                        last: '»',
                        next: '›',
                        previous: '‹',
                    },
                },
            };

            return $(selector).DataTable($.extend(true, {}, defaults, options || {}));
        };
    </script>
@endpush
