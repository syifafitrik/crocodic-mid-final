<!DOCTYPE html>

<html lang="en" translate="no">

<head>
    <base href="" />
    @if (isset($pagetitle) && !empty($pagetitle))
        <title>{{ $pagetitle }}</title>
    @else
        <title>Top Up Games by Windah Basudara</title>
    @endif
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="favicon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <link href="{{ asset('assets/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/dataTables.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/plugins/fontawesome/css/fontawesome.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/fontawesome/css/brands.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/fontawesome/css/solid.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />

    <style>
        #layoutSidenav_content {
            top: 80px !important;
            background: linear-gradient(0deg, rgba(100, 80, 180, 0.5), rgba(120, 200, 80, 0.5));
            background-repeat: repeat;
            background-attachment: fixed;
            background-position: center;
            background-size: cover;
        }
    </style>

    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>


<body class="sb-nav-fixed @if (!auth()->user()) sb-sidenav-toggled nosidebar @endif">
    @include('components.sidebar-fix')
    @include('components.navbar')

    <div id="layoutSidenav">
        @if (auth()->user())
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark show" id="sidenavAccordion">
                    @include('components.sidebar-brand')
                    
                    @include('components.sidebar_admin')
                </nav>
            </div>
        @endif
        <div class="offcanvas-backdrop sidebar-backdrop fade" id="sidebarBackdrop"></div>
        <div id="layoutSidenav_content" class="justify-content-start">
            @yield('content')
        </div>
    </div>

    @yield('modal')

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/core.js') }}"></script>
    <script src="{{ asset('assets/js/core-helper.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('script')
</body>

</html>
