@include('layouts.web.head')

<body class="@stack('body-class')">
    @include('layouts.web.header')

    @yield('content')

    @include('layouts.web.footer')
    @include('layouts.web.scripts')
    @stack('scripts')
</body>

</html>