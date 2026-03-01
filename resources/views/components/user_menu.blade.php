<ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link d-flex flex-row py-0 align-items-center" data-bs-toggle="dropdown"
            data-bs-auto-close="outside">
            <span class="pe-3 d-none d-md-flex flex-column text-end lh-sm gap-1">
                @if (auth()->user())
                    <div class="fs-6 fw-semibold">{{ auth()->user()->name }}</div>
                    <div><small>{{ auth()->user()->role }}</small></div>
                @else
                    <div class="fs-6 fw-semibold">Guest</div>
                    <div><small>Belum login</small></div>
                @endif
            </span>
            <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="Foto Profil"
                class="rounded-circle border border-2 shadow-lg object-fit-cover my-auto mw-40px mh-40px mw-md-50px mh-md-50px">
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow">
            <li class="user-header text-white bg-gradient"
                style="--bs-gradient: linear-gradient(180deg, rgba(40, 40, 100, 1), rgba(20, 50, 200, 1));">
                <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="Foto Profil"
                    class="rounded-circle border border-2 object-fit-cover mt-3">
                <div class="mt-3">
                    @if (auth()->user())
                        <div class="mb-1 fs-5 fw-semibold">{{ auth()->user()->name }}</div>
                        <div class="mb-1"><small>{{ auth()->user()->email }}</small></div>
                        <div><small class="badge bg-success">{{ auth()->user()->role }}</small></div>
                    @else
                        <div class="mb-1 fs-5 fw-semibold">Guest</div>
                        <div class="mb-1"><small>Silakan login terlebih dahulu</small></div>
                        <div><small class="badge bg-secondary">Guest</small></div>
                    @endif
                </div>
            </li>
            <li class="user-footer text-center bg-dark">
                <div class="d-flex flex-row justify-content-around gap-3">
                    <div>
                        @if (auth()->user())
                            <a href="{{ route('logout') }}" class="btn btn-sm btn-warning">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Logout
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-sm btn-success">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                Login
                            </a>
                        @endif
                    </div>
                </div>
            </li>
        </ul>
    </li>
</ul>
