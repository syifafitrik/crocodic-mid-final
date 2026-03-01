@extends('layout.admin')

@section('content')
    <div class="app-content py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <h3 class="fw-bold">Master Game</h3>
                <div class="d-flex flex-row justify-content-between">
                    Tambah, update, hapus data game.
                    <button type="button" title="Tambah data" class="btn btn-sm btn-success" onclick="show_create()">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Game
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex flex-column pb-3 gap-3">
        <div class="card">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="table_game" class="table table-bordered table-hover table-striped table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Judul Game</th>
                                <th>Slug</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
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
                            <label for="create_title" class="form-label mb-1 fs-8 fw-semibold">Judul Game<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" id="create_title" class="form-control form-control-sm"
                                placeholder="Masukkan judul game" required />
                        </div>
                        <div class="mb-3">
                            <label for="create_description" class="form-label mb-1 fs-8 fw-semibold">Deskripsi<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm" name="description" id="create_description" rows="3"
                                placeholder="Masukkan deskripsi game" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="create_image" class="form-label mb-1 fs-8 fw-semibold">Image<span
                                    class="text-danger">*</span></label>
                            <input type="file" name="image" id="create_image" class="form-control form-control-sm"
                                placeholder="Masukkan file gambar" accept="image/*" required />
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
                            <i class="fa-solid fa-square-pen text-white me-1"></i>Update Game
                        </span>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update_title" class="form-label mb-1 fs-8 fw-semibold">Judul Game<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" id="update_title" class="form-control form-control-sm"
                                placeholder="Masukkan judul game" required />
                        </div>
                        <div class="mb-3">
                            <label for="update_description" class="form-label mb-1 fs-8 fw-semibold">Deskripsi<span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control form-control-sm" name="description" id="update_description" rows="3"
                                placeholder="Masukkan deskripsi game" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="update_image" class="form-label mb-1 fs-8 fw-semibold">Image</label>
                            <input type="file" name="image" id="update_image" class="form-control form-control-sm"
                                placeholder="Masukkan file gambar" accept="image/*" />
                            <small class="fs-8"><b>NOTE: </b>Isikan jika ingin mengganti gambar.</small>
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
                            <i class="fa-solid fa-trash text-white me-1"></i>Hapus Game
                        </span>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Anda yakin ingin menghapus data dengan detail berikut?
                        </p>
                        <table class="table table-bordered table-sm mb-1 small">
                            <tbody>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Judul Game</td>
                                    <td id="delete_title"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Deskripsi</td>
                                    <td id="delete_description"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Image</td>
                                    <td id="delete_image"></td>
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

    <div class="modal fade" id="modal_image" tabindex="-1" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modal_imageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="#" id="image_src" alt="Gambar" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm mx-auto" type="button" title="Batal"
                        data-bs-dismiss="modal">
                        <span class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-xmark me-1"></i>
                            Tutup
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var selected = null;

        // show modal form
        function show_create() {
            $("#create_title").val('');
            $("#create_description").val('');
            $("#create_image").val('');

            $("#modal_create").modal('show');
            $("#create_name").focus();
        }

        function show_update(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));
            selected = data;

            $("#update_id").val(data.id);
            $("#update_title").val(data.title);
            $("#update_description").val(data.description);
            $("#update_image").val('');

            $("#modal_update").modal('show');
            $("#update_title").focus();
        }

        function show_delete(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));

            var image = data.image ? data.image : '#';
            var alt = data.image ? 'Game' : 'No Image';

            $("#delete_id").val(data.id);
            $("#delete_title").html(data.title);
            $("#delete_description").html(data.description);
            $("#delete_image").html(`
                <div class="mw-200px">
                    <img src="${image}" class="img-fluid" alt="${alt}" />    
                </div>
            `);

            $("#modal_delete").modal('show');
        }

        function show_image(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));

            $("#image_src").attr('src', data.image);
            $("#modal_image").modal('show');
        }

        // reset modal form
        function reset_create(close = false) {
            $("#create_title").val('');
            $("#create_description").val('');
            $("#create_image").val('');

            if (close)
                $("#create_title").focus();
        }

        function reset_update(current = null) {
            $("#update_id").val(current == null ? '' : current.id);
            $("#update_title").val(current == null ? '' : current.title);
            $("#update_description").val(current == null ? '' : current.description);
            $("#update_image").val('');

            if (current != null)
                $("#update_title").focus();
        }

        function reset_delete() {
            $("#delete_id").val('');
            $("#delete_title").html('');
            $("#delete_description").html('');
            $("#delete_image").html('');
        }

        function reset_image() {
            $("#image_src").attr('src', '#');
        }

        // submit form
        $("#form_create").on('submit', function(e) {
            e.preventDefault();
            blockUI.fire();

            var $image = $("#create_image")[0].files[0] ?? null;
            var data = new FormData();
            data.append('title', $("#create_title").val());
            data.append('description', $("#create_description").val());
            if ($image != null)
                data.append('image', $("#create_image")[0].files[0]);

            $.ajax({
                method: 'POST',
                url: '{{ route('admin.master_game.create') }}',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_create").modal('hide');
                        reset_create(true);
                        table_game.ajax.reload();
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

            var $image = $("#update_image")[0].files[0] ?? null;
            var data = new FormData();
            data.append('id', $("#update_id").val());
            data.append('title', $("#update_title").val());
            data.append('description', $("#update_description").val());
            if ($image != null)
                data.append('image', $("#update_image")[0].files[0]);

            $.ajax({
                method: 'POST',
                url: '{{ route('admin.master_game.update') }}',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_update").modal('hide');
                        reset_update();
                        table_game.ajax.reload();
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
                url: '{{ route('admin.master_game.delete') }}',
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_delete").modal('hide');
                        table_game.ajax.reload();
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

        var table_game = $("#table_game").DataTable({
            ajax: {
                method: 'POST',
                url: "{{ route('admin.master_game.list') }}",
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
                data: 'title',
                name: 'title',
                searchable: true,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'slug',
                name: 'slug',
                searchable: false,
                orderable: false,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'description',
                name: 'description',
                searchable: false,
                orderable: false,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'image',
                name: 'image',
                searchable: false,
                orderable: false,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    var image = data ? data : '#';
                    var alt = data ? 'Game' : 'No Image';

                    return `
                        <div class="mw-200px btn p-0" onclick="show_image(this)"
                            data-json="${ encodeURIComponent(JSON.stringify(row)) }">
                            <img src="${image}" class="img-fluid" alt="${alt}" />    
                        </div>
                    `;
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
                            title="Edit game ini" data-json="${ encodeURIComponent(JSON.stringify(row)) }"
                            onclick="show_update(this)">
                            <i class="fa fa-pen"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs fs-8"
                            title="Hapus game ini" data-json="${ encodeURIComponent(JSON.stringify(row)) }"
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
