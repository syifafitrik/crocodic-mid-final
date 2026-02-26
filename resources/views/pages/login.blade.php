<!DOCTYPE html>

<html lang="en" translate="no">

<head>
    <base href="" />
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <link href="{{ asset('assets/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>

<body>
    <div class="d-flex vh-100"
        style="
            background-image: url('{{ asset('assets/media/auth/bg-login.png') }}');
			background-attachment: fixed;
			background-size: 50%;
            background-color: rgba(32,32,164,0.25);
            ">
        <div class="card shadow-lg rounded-4 m-auto col-xl-4 col-lg-6 col-md-8 col-10 p-3 p-md-4 p-lg-5">
            <form id="form-login">
                <div class="card-body">
                    <div class="d-flex flex-column h-100 gap-3">
                        <div class="text-center mb-11">
                            <h3 class="text-dark fw-bolder mb-3">Sistem Top Up Games</h3>
                            <div class="text-gray-500 fw-semibold fs-6">Masuk ke Dashboard Sistem Top Up Games</div>
                        </div>
                        <div class="my-2"></div>
                        <input type="text" placeholder="Masukkan Username" name="username" id="username"
                            autocomplete="off" class="form-control form-control-sm bg-transparent" />
                        <input type="password" placeholder="Masukkan Password" name="password" id="password"
                            autocomplete="off" class="form-control form-control-sm bg-transparent" />
                        <div class="my-5"></div>
                        <div class="mt-auto text-center">
                            <button type="submit" id="btn_submit"
                                class="btn w-75 mt-auto fw-bold btn-sm btn-primary">Masuk</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/core-helper.js') }}"></script>
    <script>
        $("#form-login").on('submit', (e) => {
            e.preventDefault();
            go_login();
        });

        function go_login() {
            blockUI.fire();

            let data_username = $("#username").val();
            let data_password = $("#password").val();

            if (data_username == null || data_username == '') {
                blockUI.close();
                toastr.errorHtml('Data username harus diisi!');
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
                url: '{{ route('admin.login') }}',
                data: {
                    username: data_username,
                    password: data_password
                }
            }).done((result) => {
                if (result.status == 'S') {
                    blockUI.close();

                    toast.timer = 2000;
                    toast.willClose = () => {
                        window.location.href = '{{ route('admin.dashboard') }}';
                    }

                    toastr.successHtml(result.message);
                } else {
                    blockUI.close();
                    toastr.errorHtml(result.message);
                }
            });
        }
    </script>
</body>

</html>
