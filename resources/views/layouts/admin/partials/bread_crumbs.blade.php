<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h3>@yield('page_title', 'Dashboard')</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ Route::has('admin.dashboard') ? route('admin.dashboard') : url('/admin') }}">
                        <svg class="stroke-icon">
                            <use href="{{ asset('assets/admin/svg/icon-sprite.svg') }}#stroke-home"></use>
                        </svg></a>
                </li>
                @yield('breadcrumb')
                <li class="breadcrumb-item active">@yield('page_title', 'Dashboard')</li>
            </ol>
        </div>
    </div>
</div>