<div class="sb-sidenav-menu scrollbar-dark mb-3">
    <div class="nav pt-3">
        <a class="nav-link @if (
            !isset($current_page) ||
                (isset($current_page) && empty($current_page)) ||
                (isset($current_page) && $current_page == 'home')) active @endif" href="{{ url('/') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-home"></i>
            </div>
            Home
        </a>
        <div class="sb-sidenav-menu-heading">
            Transaksi
        </div>
        <a class="nav-link @if (isset($current_page) && $current_page == 'user_payment') active @endif" href="{{ route('user.payment.index') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-receipt"></i>
            </div>
            Pembelian Saya
        </a>
        <a class="nav-link @if (isset($current_page) && $current_page == 'user_history') active @endif" href="{{ route('user.history.index') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-clock"></i>
            </div>
            History Transaksi
        </a>

        <div class="sb-sidenav-menu-heading">
            Lain-Lain
        </div>
        <a class="nav-link @if (isset($current_page) && $current_page == 'user_profile') active @endif" href="{{ route('user.profile.index') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-user"></i>
            </div>
            Profile
        </a>
        <a class="nav-link" href="{{ route('logout') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            Logout
        </a>
    </div>
</div>
