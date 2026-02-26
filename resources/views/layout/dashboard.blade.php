@include('components.head')

<body class="sb-nav-fixed @if (!auth()->user()) sb-sidenav-toggled nosidebar @endif">
    @include('components.sidebar-fix')
    @include('components.navbar')

    <div id="layoutSidenav">
        @if (auth()->user())
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark show" id="sidenavAccordion">
                    @include('components.sidebar-brand')
                    @if (auth()->user() && auth()->user()->role == 'ADMIN')
                        @include('components.sidebar_admin')
                    @elseif(auth()->user())
                        @include('components.sidebar_user')
                    @endif
                </nav>
            </div>
        @endif
        <div class="offcanvas-backdrop sidebar-backdrop fade" id="sidebarBackdrop"></div>
        <div id="layoutSidenav_content">
            @yield('content')
        </div>
    </div>

    @include('components.script')
</body>

</html>
