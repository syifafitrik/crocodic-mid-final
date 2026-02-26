<nav
    class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow-lg d-flex flex-row justify-content-start gap-3 px-0">
    <div class="w-100 h-100 d-flex flex-row justify-content-between align-items-center gap-2 me-2">
        @if(auth()->user())
        <button class="btn btn-link btn-sm shadow-none order-0" title="" type="button" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        @else
        <div class="w-md-200px">
            @include('components.sidebar-brand')
        </div>
        @endif
        @include('components.user_menu')
    </div>
</nav>
