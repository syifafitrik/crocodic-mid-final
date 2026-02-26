@include('components.head')

<body class="sb-nav-fixed">
    @include('components.sidebar_fix')
    @include('components.navbar')

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark show" id="sidenavAccordion">
                <div class="px-3 bg-success">
                    @include('components.user_menu')
                </div>
                @include('components.sidebar')
            </nav>
        </div>
        <div class="offcanvas-backdrop sidebar-backdrop fade" id="sidebarBackdrop"></div>
        <div id="layoutSidenav_content">
            @yield('content')
        </div>
    </div>

    @include('components.script')
</body>

</html>