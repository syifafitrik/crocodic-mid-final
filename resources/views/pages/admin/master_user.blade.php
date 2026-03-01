@extends('layout.admin')

@section('content')
    <div class="app-content py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <h3 class="fw-bold">Master User</h3>
                <div class="d-flex flex-row justify-content-between">
                    Tambah, update, hapus data user.
                    <button type="button" title="Tambah data" class="btn btn-sm btn-success" onclick="show_create()">
                        <i class="fa-solid fa-plus me-1"></i>Tambah User
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex flex-column pb-3 gap-3">
        <div class="card">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="table_user" class="table table-bordered table-hover table-striped table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>E-Mail</th>
                                <th>Role</th>
                                <th>Dibuat Pada</th>
                                <th>Diperbaharui Pada</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <form id="form_create">
        <div class="modal fade" id="modal_create" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modal_createTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <span class="modal-title fs-5 d-flex flex-row align-items-center" id="modal_createTitle">
                            <i class="fa-solid fa-square-plus text-white me-1"></i>Tambah User
                        </span>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_name" class="form-label mb-1 fs-8 fw-semibold">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="create_name" class="form-control form-control-sm"
                                placeholder="Masukkan nama lengkap" required />
                        </div>
                        <div class="mb-3">
                            <label for="create_username" class="form-label mb-1 fs-8 fw-semibold">Username<span class="text-danger">*</span></label>
                            <input type="text" name="username" id="create_username" class="form-control form-control-sm"
                                placeholder="Masukkan username untuk login" required />
                        </div>
                        <div class="mb-3">
                            <label for="create_email" class="form-label mb-1 fs-8 fw-semibold">E-Mail<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="create_email" class="form-control form-control-sm"
                                placeholder="Masukkan alamat e-mail" required />
                        </div>
                        <div class="mb-3">
                            <label for="create_password" class="form-label mb-1 fs-8 fw-semibold">Password<span class="text-danger">*</span></label>
                            <input type="password" name="password" id="create_password" class="form-control form-control-sm"
                                placeholder="Masukkan password baru" minlength="6" required/>
                        </div>
                        <div class="mb-3">
                            <label for="create_role" class="form-label mb-1 fs-8 fw-semibold">Role<span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="role" id="create_role" required>
                                <option value="" selected hidden disabled>- Silakan Pilih Role -</option>
                                <option value="USER">User</option>
                                <option value="ADMIN">Administrator</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-sm" type="submit" title="Simpan">
                            <span class="d-flex flex-row align-items-center">
                                <i class="fa-solid fa-save me-1"></i>
                                Tambah
                            </span>
                        </button>
                        <button class="btn btn-warning btn-sm" type="button" title="Ulangi" onclick="reset_create();">
                            <span class="d-flex flex-row align-items-center">
                                <i class="fa-solid fa-refresh me-1"></i>
                                Ulangi
                            </span>
                        </button>
                        <button class="btn btn-secondary btn-sm ms-auto" type="button" title="Batal"
                            data-bs-dismiss="modal" onclick="reset_create(true);">
                            <span class="d-flex flex-row align-items-center">
                                <i class="fa-solid fa-xmark me-1"></i>
                                Batal
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="form_update">
        <div class="modal fade" id="modal_update" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modal_updateTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <span class="modal-title fs-5 d-flex flex-row align-items-center" id="modal_updateTitle">
                            <i class="fa-solid fa-square-pen text-white me-1"></i>Update User
                        </span>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update_name" class="form-label mb-1 fs-8 fw-semibold">Nama Lengkap<span class="text-danger">*</span></label>
                            <input type="text" name="name" id="update_name" class="form-control form-control-sm"
                                placeholder="Masukkan nama lengkap" required />
                        </div>
                        <div class="mb-3">
                            <label for="update_username" class="form-label mb-1 fs-8 fw-semibold">Username<span class="text-danger">*</span></label>
                            <input type="text" name="username" id="update_username" class="form-control form-control-sm"
                                placeholder="Masukkan username untuk login" required />
                        </div>
                        <div class="mb-3">
                            <label for="update_email" class="form-label mb-1 fs-8 fw-semibold">E-Mail<span class="text-danger">*</span></label>
                            <input type="email" name="email" id="update_email" class="form-control form-control-sm"
                                placeholder="Masukkan alamat e-mail" required />
                        </div>
                        <div class="mb-3">
                            <label for="update_password" class="form-label mb-1 fs-8 fw-semibold">Password</label>
                            <input type="password" name="password" id="update_password" class="form-control form-control-sm"
                                placeholder="Kosongkan jika tidak ingin mengubah password" minlength="6" />
                        </div>
                        <div class="mb-3">
                            <label for="update_role" class="form-label mb-1 fs-8 fw-semibold">Role<span class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="role" id="update_role" required>
                                <option value="" selected hidden disabled>- Silakan Pilih Role -</option>
                                <option value="USER">User</option>
                                <option value="ADMIN">Administrator</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-sm" type="submit" title="Simpan">
                            <span class="d-flex flex-row align-items-center">
                                <i class="fa-solid fa-save me-1"></i>
                                Update
                            </span>
                        </button>
                        <button class="btn btn-warning btn-sm" type="button" title="Ulangi"
                            onclick="reset_update(selected);">
                            <span class="d-flex flex-row align-items-center">
                                <i class="fa-solid fa-refresh me-1"></i>
                                Ulangi
                            </span>
                        </button>
                        <button class="btn btn-secondary btn-sm ms-auto" type="button" title="Batal"
                            data-bs-dismiss="modal" onclick="reset_update();">
                            <span class="d-flex flex-row align-items-center">
                                <i class="fa-solid fa-xmark me-1"></i>
                                Batal
                            </span>
                        </button>
                        <input type="hidden" id="update_id" name="id">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form id="form_delete">
        <div class="modal fade" id="modal_delete" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
            role="dialog" aria-labelledby="modal_deleteTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <span class="modal-title fs-5 d-flex flex-row align-items-center" id="modal_deleteTitle">
                            <i class="fa-solid fa-trash text-white me-1"></i>Hapus User
                        </span>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Anda yakin ingin menghapus data dengan detail berikut?
                        </p>
                        <table class="table table-bordered table-sm mb-1 small">
                            <tbody>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Nama</td>
                                    <td id="delete_name"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Username</td>
                                    <td id="delete_username"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">E-Mail</td>
                                    <td id="delete_email"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Role</td>
                                    <td id="delete_role"></td>
                                </tr>
                            </tbody>
                        </table>
                        <small class="fs-9">
                            <i class="fa-solid fa-exclamation-triangle text-warning me-1"></i>Data yang sudah dihapus tidak
                            dapat dikembalikan</small>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-danger btn-sm" type="submit" title="Hapus">
                            <span class="d-flex flex-row align-items-center">
                                <i class="fa-solid fa-trash me-1"></i>
                                Hapus
                            </span>
                        </button>
                        <button class="btn btn-secondary btn-sm ms-auto" type="button" title="Batal"
                            data-bs-dismiss="modal">
                            <span class="d-flex flex-row align-items-center">
                                <i class="fa-solid fa-xmark me-1"></i>
                                Batal
                            </span>
                        </button>
                        <input type="hidden" id="delete_id" name="id">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        var selected = null;

        // show modal form
        function show_create() {
            $("#create_name").val('');
            $("#create_username").val('');
            $("#create_email").val('');
            $("#create_password").val('');
            $("#create_role").val('');

            $("#modal_create").modal('show');
            $("#create_name").focus();
        }

        function show_update(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));
            selected = data;

            $("#update_id").val(data.id);
            $("#update_name").val(data.name);
            $("#update_username").val(data.username);
            $("#update_email").val(data.email);
            $("#update_password").val('');
            $("#update_role").val(data.role);

            $("#modal_update").modal('show');
            $("#update_name").focus();
        }

        function show_delete(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));

            $("#delete_id").val(data.id);
            $("#delete_name").html(capitalizeEachWord(data.name));
            $("#delete_username").html(data.username.toLowerCase());
            $("#delete_email").html(data.email.toLowerCase());
            $("#delete_role").html(capitalizeEachWord(data.role, true));

            $("#modal_delete").modal('show');
        }

        // reset modal form
        function reset_create(close = false) {
            $("#create_name").val('');
            $("#create_username").val('');
            $("#create_email").val('');
            $("#create_password").val('');
            $("#create_role").val('');

            if (close)
                $("#create_name").focus();
        }

        function reset_update(current = null) {
            $("#update_id").val(current == null ? '' : current.id);
            $("#update_name").val(current == null ? '' : current.name);
            $("#update_username").val(current == null ? '' : current.username);
            $("#update_password").val('');
            $("#update_email").val(current == null ? '' : current.email);
            $("#update_role").val(current == null ? '' : current.role);

            if (current != null)
                $("#update_name").focus();
        }

        function reset_delete() {
            $("#delete_id").val('');
            $("#delete_name").html('');
            $("#delete_username").html('');
            $("#delete_email").html('');
            $("#delete_role").html('');
        }

        // submit form
        $("#form_create").on('submit', function(e) {
            e.preventDefault();
            blockUI.fire();

            $.ajax({
                method: 'POST',
                url: '{{ route('admin.master_user.create') }}',
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_create").modal('hide');
                        reset_create(true);
                        table_user.ajax.reload();
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function(result, status, xhr) {
                    blockUI.close();
                    toastr.error(result.message);
                }
            });
        })

        $("#form_update").on('submit', function(e) {
            e.preventDefault();
            blockUI.fire();

            $.ajax({
                method: 'POST',
                url: '{{ route('admin.master_user.update') }}',
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_update").modal('hide');
                        reset_update();
                        table_user.ajax.reload();
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function(result, status, xhr) {
                    blockUI.close();
                    toastr.error(result.message);
                }
            });
        })

        $("#form_delete").on('submit', function(e) {
            e.preventDefault();
            blockUI.fire();

            $.ajax({
                method: 'POST',
                url: '{{ route('admin.master_user.delete') }}',
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_delete").modal('hide');
                        reset_delete();
                        table_user.ajax.reload();
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function(result, status, xhr) {
                    blockUI.close();
                    toastr.error(result.message);
                }
            });
        })

        var table_user = $("#table_user").DataTable({
            ajax: {
                method: 'POST',
                url: "{{ route('admin.master_user.list') }}",
                dataSrc: 'data'
            },
            columns: [{
                data: 'id',
                name: 'id',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            }, {
                data: 'name',
                name: 'name',
                searchable: true,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'username',
                name: 'username',
                searchable: true,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'email',
                name: 'email',
                searchable: true,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'role',
                name: 'role',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    return data == 'ADMIN' ?
                        `<small class="badge bg-success">Admin</small>` :
                        `<small class="badge bg-primary">User</small>`;
                }
            }, {
                data: 'created_at',
                name: 'created_at',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'updated_at',
                name: 'updated_at',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'id',
                name: 'id',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    return `
                        <button type="button" class="btn btn-primary btn-xs fs-8"
                            title="Edit user ini" data-json="${ encodeURIComponent(JSON.stringify(row)) }"
                            onclick="show_update(this)">
                            <i class="fa fa-pen"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs fs-8"
                            title="Hapus user ini" data-json="${ encodeURIComponent(JSON.stringify(row)) }"
                            onclick="show_delete(this)">
                            <i class="fa fa-trash"></i>
                        </button>
                    `;
                }
            }],
            order: [],
            serverSide: false,
            search: {
                return: true
            },
            processing: true,
            searching: true,
            scrollX: true,
        });
    </script>
@endsection
