<div class="my-auto d-flex align-items-center min-h-80px">
    <div class="text-start text-light m-0 d-flex flex-row gap-3 min-h-60px">
        <img src="{{ asset('assets/media/avatars/blank.png') }}" alt="Foto Profil"
            class="rounded-circle border border-2 shadow-lg object-fit-cover my-auto mw-40px mh-40px mw-md-50px mh-md-50px">
        <div class="d-flex flex-column justify-content-center mw-100px min-w-100px mw-md-unset w-md-auto mh-80px">
            @if (auth()->user())
                <span class="fw-bold text-wrap text-truncate lh-sm fs-lg-6 fs-md-7 fs-8"
                    style="max-height: calc(var(--custom-font-size) + (var(--custom-font-size) * 1.5));">{{ auth()->user()->name }}</span>
                <span class="fs-lg-7 fs-md-8 fs-9"
                    style="margin-top: calc(var(--custom-font-size) * 0.25);">{{ auth()->user()->role ?? 'USER' }}</span>
            @else
                <span class="fw-bold text-wrap text-truncate lh-sm fs-lg-6 fs-md-7 fs-8"
                    style="max-height: calc(var(--custom-font-size) + (var(--custom-font-size) * 1.5));">Guest</span>
                <span class="fs-lg-7 fs-md-8 fs-9" style="margin-top: calc(var(--custom-font-size) * 0.25);">Silakan
                    login terlebih dahulu.</span>
            @endif
        </div>
    </div>
</div>
