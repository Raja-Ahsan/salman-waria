    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities."
    />
    <meta
      name="keywords"
      content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app"
    />
    <meta name="author" content="pixelstrap" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg+xml" />
    <!-- Google font-->
    <link
      href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap"
      rel="stylesheet"
    />
    <!-- Font Awesome-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/fontawesome.css') }}"
    />
    <!-- ico-font-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/icofont.css') }}"
    />
    <!-- Themify icon-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/themify.css') }}"
    />
    <!-- Flag icon-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/flag-icon.css') }}"
    />
    <!-- Feather icon-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/feather-icon.css') }}"
    />
    <!-- Plugins css start-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/slick.css') }}"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/slick-theme.css') }}"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/scrollbar.css') }}"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/animate.css') }}"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/jquery.dataTables.css') }}"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/dataTables.bootstrap5.css') }}"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/select.bootstrap5.css') }}"
    />
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/vendors/bootstrap.css') }}"
    />
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}" />
    <!-- Responsive css-->
    <link
      rel="stylesheet"
      type="text/css"
      href="{{ asset('assets/admin/css/responsive.css') }}"
    />
    <script defer src="{{ asset('assets/admin/css/responsive.js') }}"></script>
    <script defer src="{{ asset('assets/admin/css/style.js') }}"></script>
    <link href="{{ asset('assets/admin/css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/admin/css/style.css') }}" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Space+Grotesk:wght@500;600&display=swap"
      rel="stylesheet"
    />
    <style>
      .logo-wrapper .sw-admin-brand {
        display: flex;
        flex-direction: column;
        gap: 3px;
        text-decoration: none;
        padding: 6px 0;
        line-height: 1.15;
        max-width: 100%;
      }

      .sw-admin-brand__name {
        font-family: 'Playfair Display', Georgia, serif;
        font-size: clamp(1.15rem, 2vw, 1.4rem);
        font-weight: 700;
        color: #2c323f;
        white-space: nowrap;
      }

      .sw-admin-brand__accent {
        color: #c9a84c;
      }

      .sw-admin-brand__tag {
        font-family: 'Space Grotesk', sans-serif;
        font-size: 0.62rem;
        font-weight: 600;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #8996a4;
      }

      .sw-admin-brand--compact .sw-admin-brand__name {
        font-size: 1.05rem;
      }

      body.dark-only .sw-admin-brand__name,
      .dark-sidebar .sw-admin-brand__name {
        color: #f5f5f5;
      }

      .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper .logo-wrapper {
        padding: 18px 24px;
        min-height: 78px;
        display: flex;
        align-items: center;
      }

      .page-wrapper.compact-wrapper .page-header .header-wrapper .logo-wrapper {
        padding: 12px 0;
        min-width: 0;
      }

      .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper.close_icon .sw-admin-brand__tag {
        display: none;
      }

      .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper.close_icon .sw-admin-brand__name {
        font-size: 0;
        line-height: 1;
      }

      .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper.close_icon .sw-admin-brand__name::before {
        content: 'SW';
        font-size: 1rem;
        font-family: 'Playfair Display', Georgia, serif;
        font-weight: 700;
        color: #2c323f;
      }

      body.dark-only .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper.close_icon .sw-admin-brand__name::before,
      .dark-sidebar .page-wrapper.compact-wrapper .page-body-wrapper div.sidebar-wrapper.close_icon .sw-admin-brand__name::before {
        color: #f5f5f5;
      }

      .swal2-container .swal2-actions .swal2-confirm,
      .swal2-container .swal2-actions .swal2-confirm:hover,
      .swal2-container .swal2-actions .swal2-confirm:focus {
        color: #fff !important;
      }

      .swal2-container .swal2-actions .swal2-deny,
      .swal2-container .swal2-actions .swal2-deny:hover,
      .swal2-container .swal2-actions .swal2-deny:focus {
        color: #fff !important;
      }
    </style>
    @stack('styles')
  