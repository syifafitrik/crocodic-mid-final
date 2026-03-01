@extends('layout.guest')

@section('content')
    <div class="card shadow-lg rounded-4 m-auto col-xl-4 col-lg-6 col-md-8 col-10 p-3 p-md-4 p-lg-5">
        <form id="form-register">
            <div class="card-body">
                <div class="d-flex flex-column h-100 gap-3">
                    <div class="text-center mb-11">
                        <h3 class="text-dark fw-bolder mb-3">Sistem Top Up Games</h3>
                        <div class="text-gray-500 fw-semibold fs-6">Mulai Langkah Awal Registrasi dengan Mengisi Formulir
                            dan Mendaftarkan Akun Baru Anda </div>
                    </div>
                    <div class="my-2"></div>
                    <input type="text" placeholder="Masukkan Nama" name="name" id="name" autocomplete="off"
                        class="form-control form-control-sm bg-transparent" />
                    <input type="text" placeholder="Masukkan Username" name="username" id="username" autocomplete="off"
                        class="form-control form-control-sm bg-transparent" />
                    <input type="password" placeholder="Masukkan Password" name="password" id="password" minlength="6" autocomplete="off"
                        class="form-control form-control-sm bg-transparent" />
                    <input type="text" placeholder="Masukkan Email" name="email" id="email" autocomplete="off"
                        class="form-control form-control-sm bg-transparent" />
                    <div class="my-5"></div>
                    <div class="mt-auto text-center">
                        <button type="submit" id="btn_submit"
                            class="btn w-75 mt-auto fw-bold btn-sm btn-primary">Register</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $("#form-register").on('submit', (e) => {
            e.preventDefault();
            go_register();
        });

        function go_register() {
            blockUI.fire();

            let data_name = $("#name").val();
            let data_username = $("#username").val();
            let data_email = $("#email").val();
            let data_password = $("#password").val();

            if (data_name == null || data_name == '') {
                blockUI.close();
                toastr.errorHtml('Nama lengkap harus diisi!');
                return;
            }

            if (data_username == null || data_username == '') {
                blockUI.close();
                toastr.errorHtml('Data username harus diisi!');
                return;
            }

            if (data_email == null || data_email == '') {
                blockUI.close();
                toastr.errorHtml('Data alamat e-mail harus diisi!');
                return;
            }

            if (data_password == null || data_password == '') {
                blockUI.close();
                toastr.errorHtml('Data password harus diisi!');
                return;
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                method: 'POST',
                url: '{{ route('register') }}',
                data: {
                    name: data_name,
                    username: data_username,
                    email: data_email,
                    password: data_password
                }
            }).done((result) => {
                if (result.status == 'S') {
                    blockUI.close();

                    toast.timer = 2000;
                    toast.willClose = () => {
                        window.location.href = '{{ route('login') }}';
                    }

                    toastr.successHtml(result.message);
                } else {
                    blockUI.close();
                    toastr.errorHtml(result.message);
                }
            });
        }
    </script>
@endsection
