@php
    $modules = dynamic_sidebar();
    $blogRouteNames = ['blogs.index', 'blogs.create', 'blogs.edit', 'blogs.store', 'blogs.update', 'blogs.destroy', 'blogs.upload-image'];
    $blogCategoryRouteNames = ['blog-categories.index', 'blog-categories.create', 'blog-categories.edit', 'blog-categories.store', 'blog-categories.update', 'blog-categories.destroy'];
@endphp

<div class="sidebar-wrapper" data-sidebar-layout="stroke-svg">
    <div class="logo-wrapper">
        @include('layouts.admin.partials.brand')

        <div class="back-btn">
            <i class="fa-solid fa-angle-left"></i>
        </div>
    </div>

    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow">
            <i data-feather="arrow-left"></i>
        </div>

        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn">
                    <div class="mobile-back text-end">
                        <span>Back</span>
                        <i class="fa-solid fa-angle-right ps-2" aria-hidden="true"></i>
                    </div>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6>Menu</h6>
                    </div>
                </li>

                @foreach ($modules as $module)
                    @php
                        $hasChildren = $module->children && $module->children->count() > 0;
                        $moduleRoute = $module->route_name;

                        $childActive = false;
                        if ($hasChildren) {
                            foreach ($module->children as $child) {
                                if ($child->route_name === 'blogs.index' && request()->routeIs($blogRouteNames)) {
                                    $childActive = true;
                                    break;
                                }
                                if ($child->route_name === 'blog-categories.index' && request()->routeIs($blogCategoryRouteNames)) {
                                    $childActive = true;
                                    break;
                                }
                                if (Route::has($child->route_name) && request()->routeIs($child->route_name)) {
                                    $childActive = true;
                                    break;
                                }
                            }
                        }

                        $isActive = $hasChildren
                            ? $childActive
                            : (Route::has($moduleRoute) && request()->routeIs($moduleRoute));
                    @endphp

                    <li class="sidebar-list {{ $isActive ? 'active' : '' }}">
                        <i class="fa-solid fa-thumbtack"></i>

                        <a
                            href="{{ $hasChildren ? '#' : (Route::has($moduleRoute) ? route($moduleRoute) : '#') }}"
                            class="sidebar-link sidebar-title {{ $hasChildren ? '' : 'link-nav' }} {{ $isActive && ! $hasChildren ? 'active' : '' }}"
                            @if ($hasChildren) aria-expanded="{{ $childActive ? 'true' : 'false' }}" @endif
                        >
                            <span class="theme-icons">
                                <i class="{{ $module->icon }}"></i>
                            </span>

                            <span>{{ $module->name }}</span>

                            @if ($hasChildren)
                                <div class="according-menu">
                                    <i class="fa-solid fa-angle-right"></i>
                                </div>
                            @endif
                        </a>

                        @if ($hasChildren)
                            <ul class="sidebar-submenu" @if ($childActive) style="display: block;" @endif>
                                @foreach ($module->children as $child)
                                    @php
                                        $childRoute = $child->route_name;
                                        $isChildActive = ($childRoute === 'blogs.index' && request()->routeIs($blogRouteNames))
                                            || ($childRoute === 'blog-categories.index' && request()->routeIs($blogCategoryRouteNames))
                                            || (Route::has($childRoute) && request()->routeIs($childRoute));
                                    @endphp
                                    <li>
                                        <a
                                            href="{{ Route::has($childRoute) ? route($childRoute) : '#' }}"
                                            class="{{ $isChildActive ? 'active' : '' }}"
                                        >
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach

                <li class="sidebar-main-title">
                    <div>
                        <h6>Website</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a href="{{ url('/') }}" class="sidebar-link sidebar-title link-nav" target="_blank" rel="noopener noreferrer">
                        <span class="theme-icons">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </span>
                        <span>View Live Site</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a href="{{ route('blog.index') }}" class="sidebar-link sidebar-title link-nav" target="_blank" rel="noopener noreferrer">
                        <span class="theme-icons">
                            <i class="fa-solid fa-blog"></i>
                        </span>
                        <span>Public Blog</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="right-arrow" id="right-arrow">
            <i data-feather="arrow-right"></i>
        </div>
    </nav>
</div>
