<div class="sb-sidenav-menu scrollbar-dark mb-3">
    <div class="nav pt-3">
        <a class="nav-link @if (
            !isset($current_page) ||
                (isset($current_page) && empty($current_page)) ||
                (isset($current_page) && $current_page == 'dashboard')) active @endif" href="{{ route('admin.dashboard.index') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-home"></i>
            </div>
            Dashboard
        </a>
        <div class="sb-sidenav-menu-heading">
            Transaksi
        </div>
        <a class="nav-link @if (isset($current_page) && $current_page == 'transaksi') active @endif" href="{{ route('admin.transaksi.index') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-history"></i>
            </div>
            Riwayat Pembelian
        </a>
        <div class="sb-sidenav-menu-heading">
            Master Data
        </div>
        <a class="nav-link @if (isset($current_page) && $current_page == 'master_game') active @endif" href="{{ route('admin.master_game.index') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-gamepad"></i>
            </div>
            Master Game
        </a>
        <a class="nav-link @if (isset($current_page) && $current_page == 'master_voucher') active @endif" href="{{ route('admin.master_voucher.index') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-ticket"></i>
            </div>
            Master Voucher
        </a>
        <a class="nav-link @if (isset($current_page) && $current_page == 'master_user') active @endif" href="{{ route('admin.master_user.index') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-user"></i>
            </div>
            Master User
        </a>

        <div class="sb-sidenav-menu-heading">
            Lain-Lain
        </div>
        <a class="nav-link" href="{{ route('logout') }}" type="button">
            <div class="sb-nav-link-icon">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            Logout
        </a>
    </div>
</div>
