@extends('layout.user')

@section('content')
    <div class="app-content py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <h3 class="fw-bold">Profile Saya</h3>
                <div class="d-flex flex-row justify-content-between">
                    Ubah data diri dan password akun di sini.
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid d-flex flex-column pb-3 gap-3">
        <div class="card">
            <form id="form_profile">
                <div class="card-body p-3">
                    <div class="mb-3 pb-2 border-bottom border-2 d-flex flex-column flex-md-row"
                        style="border-bottom-style: dashed !important;">
                        <div class="col-md-4 d-flex flex-column pe-md-3 mb-1 mb-md-0">
                            <label for="user_name" class="form-label mb-0 fw-semibold">Name:</label>
                            <small class="fs-9 small d-none d-md-flex">Nama lengkap user</small>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" id="user_name" name="name"
                                value="{{ $user->name }}" placeholder="Isikan nama lengkap user" />
                        </div>
                    </div>
                    <div class="mb-3 pb-2 border-bottom border-2 d-flex flex-column flex-md-row"
                        style="border-bottom-style: dashed !important;">
                        <div class="col-md-4 d-flex flex-column pe-md-3 mb-1 mb-md-0">
                            <label for="user_username" class="form-label mb-0 fw-semibold">Username:</label>
                            <small class="fs-9 small d-none d-md-flex">Username yang digunakan untuk login. Tidak bisa
                                diubah</small>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" id="user_username" readonly
                                value="{{ $user->username }}" placeholder="Isikan username user" />
                        </div>
                    </div>
                    <div class="mb-3 pb-2 border-bottom border-2 d-flex flex-column flex-md-row"
                        style="border-bottom-style: dashed !important;">
                        <div class="col-md-4 d-flex flex-column pe-md-3 mb-1 mb-md-0">
                            <label for="user_email" class="form-label mb-0 fw-semibold">E-Mail:</label>
                            <small class="fs-9 small d-none d-md-flex">Alamat e-mail user</small>
                        </div>
                        <div class="col">
                            <input type="email" class="form-control form-control-sm" id="user_email" name="email"
                                value="{{ $user->email }}" placeholder="Isikan alamat e-mail user" />
                        </div>
                    </div>
                    <div class="mb-3 pb-2 border-bottom border-2 d-flex flex-column flex-md-row"
                        style="border-bottom-style: dashed !important;">
                        <div class="col-md-4 d-flex flex-column pe-md-3 mb-1 mb-md-0">
                            <label for="user_password" class="form-label mb-0 fw-semibold">Password:</label>
                            <small class="fs-9 small d-none d-md-flex">Password yang digunakan untuk login. </small>
                        </div>
                        <div class="col">
                            <input type="password" class="form-control form-control-sm" id="user_password" minlength="6"
                                name="password" value="" placeholder="Isikan untuk mengubah password user" />
                        </div>
                    </div>
                    <div class="mb-3 pb-2 border-bottom border-2 d-flex flex-column flex-md-row"
                        style="border-bottom-style: dashed !important;">
                        <div class="col-md-4 d-flex flex-column pe-md-3 mb-1 mb-md-0">
                            <label for="user_role" class="form-label mb-0 fw-semibold">Role:</label>
                            <small class="fs-9 small d-none d-md-flex">Role user. Tidak bisa diubah</small>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" id="user_role" readonly
                                value="{{ ucwords(strtolower($user->role)) }}" placeholder="Isikan role user" />
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary" type="submit" title="Simpan">
                        <i class="fa-solid fa-save me-1"></i>Simpan
                    </button>
                    <button class="btn btn-sm btn-warning" type="button" title="Reset" onclick="reset_profile();">
                        <i class="fa-solid fa-refresh me-1"></i>Ulangi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('script')
    <script>
        function reset_profile() {
            $("#user_name").val('{{ $user->name }}');
            $("#user_username").val('{{ $user->username }}');
            $("#user_email").val('{{ $user->email }}');
            $("#user_password").val('');
            $("#user_role").val('{{ ucwords(strtolower($user->role)) }}');
        }

        $("#form_profile").on('submit', function(e) {
            e.preventDefault();
            blockUI.fire();

            $.ajax({
                method: 'POST',
                url: '{{ route('user.profile.update') }}',
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toast.timer = 2000;
                        toast.willClose = () => {
                            window.location.reload();
                        }
                        
                        toastr.success(result.message);
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function(result, status, xhr) {
                    blockUI.close();
                    toastr.error(result.message);
                }
            });
        });
    </script>
@endsection
