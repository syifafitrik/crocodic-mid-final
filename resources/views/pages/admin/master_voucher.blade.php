@extends('layout.admin')

@section('content')
    <div class="app-content py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <h3 class="fw-bold">Master Voucher</h3>
                <div class="d-flex flex-row justify-content-between">
                    Tambah, update, hapus data voucher game.
                    <button type="button" title="Tambah data" class="btn btn-sm btn-success" onclick="show_create()">
                        <i class="fa-solid fa-plus me-1"></i>Tambah Voucher
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex flex-column pb-3 gap-3">
        <div class="card">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="table_voucher" class="table table-bordered table-hover table-striped table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Nama Game</th>
                                <th>Judul Voucher</th>
                                <th>Nilai Voucher</th>
                                <th>Harga Voucher</th>
                                <th>Status HOT</th>
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
                            <i class="fa-solid fa-square-plus text-white me-1"></i>Tambah Voucher
                        </span>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="create_game_id" class="form-label mb-1 fs-8 fw-semibold">Game<span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="game_id" id="create_game_id" required>
                                <option value="" selected hidden disabled>- Silakan Pilih Game -</option>
                                @foreach ($master_game as $data)
                                    @if ($data->is_active == '1')
                                        <option value="{{ $data->id }}">{{ $data->title }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="create_title" class="form-label mb-1 fs-8 fw-semibold">Judul Voucher<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" id="create_title" class="form-control form-control-sm"
                                placeholder="Masukkan judul voucher" required />
                        </div>
                        <div class="mb-3">
                            <label for="create_value" class="form-label mb-1 fs-8 fw-semibold">Nilai Voucher<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" name="value" id="create_value"
                                class="form-control form-control-sm" placeholder="Masukkan nilai voucher" required />
                            <small class="fs-8"><b>NOTE: </b>Nilai mata uang di dalam gamenya (in game currency).</small>
                        </div>
                        <div class="mb-3">
                            <label for="create_price" class="form-label mb-1 fs-8 fw-semibold">Harga Voucher (Rp.)<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" name="price" id="create_price"
                                class="form-control form-control-sm" placeholder="Masukkan harga voucher (Rp.)" />
                        </div>
                        <div class="mb-2 d-flex flex-row gap-2">
                            <div class="form-check form-check-sm">
                                <input class="form-check-input" type="checkbox" value="1" id="create_is_hot" />
                                <label class="form-check-label" for="create_is_hot"> Hot / Trending </label>
                            </div>
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
                            <i class="fa-solid fa-square-pen text-white me-1"></i>Update Voucher
                        </span>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="update_game_id" class="form-label mb-1 fs-8 fw-semibold">Game<span
                                    class="text-danger">*</span></label>
                            <select class="form-select form-select-sm" name="game_id" id="update_game_id" required>
                                <option value="" selected hidden disabled>- Silakan Pilih Game -</option>
                                @foreach ($master_game as $data)
                                    <option value="{{ $data->id }}" @if ($data->is_active == '0') hidden @endif>
                                        {{ $data->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="update_title" class="form-label mb-1 fs-8 fw-semibold">Judul Voucher<span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" id="update_title" class="form-control form-control-sm"
                                placeholder="Masukkan judul voucher" required />
                        </div>
                        <div class="mb-3">
                            <label for="update_value" class="form-label mb-1 fs-8 fw-semibold">Nilai Voucher<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" name="value" id="update_value"
                                class="form-control form-control-sm" placeholder="Masukkan nilai voucher" required />
                            <small class="fs-8"><b>NOTE: </b>Nilai mata uang di dalam gamenya (in game currency).</small>
                        </div>
                        <div class="mb-3">
                            <label for="update_price" class="form-label mb-1 fs-8 fw-semibold">Harga Voucher (Rp.)<span
                                    class="text-danger">*</span></label>
                            <input type="number" min="0" name="price" id="update_price"
                                class="form-control form-control-sm" placeholder="Masukkan harga voucher (Rp.)" />
                        </div>
                        <div class="mb-2 d-flex flex-row gap-2">
                            <div class="form-check form-check-sm">
                                <input class="form-check-input" type="checkbox" value="1" id="update_is_hot" />
                                <label class="form-check-label" for="update_is_hot"> Hot / Trending </label>
                            </div>
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
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Judul Game</td>
                                    <td id="delete_game"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Judul Voucher</td>
                                    <td id="delete_title"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Nilai Voucher</td>
                                    <td id="delete_value"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Harga Voucher</td>
                                    <td id="delete_price"></td>
                                </tr>
                                <tr>
                                    <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Is Hot / Trending</td>
                                    <td id="delete_is_hot"></td>
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
        var $master_game = @json($master_game);
        var selected = null;

        // show modal form
        function show_create() {
            $("#create_game_id").val('');
            $("#create_title").val('');
            $("#create_value").val('');
            $("#create_price").val('');
            $("#create_is_hot").prop('checked', false);

            $("#modal_create").modal('show');
            $("#create_game_id").focus();
        }

        function show_update(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));
            selected = data;

            $("#update_id").val(data.id);
            $("#update_game_id").val(data.game_id);
            $("#update_title").val(data.voucher_title);
            $("#update_value").val(data.voucher_value);
            $("#update_price").val(data.voucher_price);
            $("#update_is_hot").prop('checked', data.is_hot == '1' ? true : false);

            $("#modal_update").modal('show');
            $("#update_game_id").focus();
        }

        function show_delete(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));
            var game = findInObject($master_game, {
                id: data.game_id
            })[0];

            $("#delete_id").val(data.id);
            $("#delete_game").html(game.title);
            $("#delete_title").html(data.voucher_title);
            $("#delete_value").html(data.voucher_value);
            $("#delete_price").html("Rp. " + float2thousand(data.voucher_price));
            $("#delete_is_hot").html(data.is_hot ? 'Ya' : 'Tidak');

            $("#modal_delete").modal('show');
        }

        // reset modal form
        function reset_create(close = false) {
            $("#create_game_id").val('');
            $("#create_title").val('');
            $("#create_value").val('');
            $("#create_price").val('');
            $("#create_is_hot").prop('checked', false);

            if (close)
                $("#create_game_id").focus();
        }

        function reset_update(current = null) {
            $("#update_id").val(current == null ? '' : data.id);
            $("#update_game_id").val(current == null ? '' : data.game_id);
            $("#update_title").val(current == null ? '' : data.voucher_title);
            $("#update_value").val(current == null ? '' : data.voucher_value);
            $("#update_price").val(current == null ? '' : data.voucher_price);
            $("#update_is_hot").prop('checked', current == null ? false : (data.is_hot == '1' ? true : false));

            if (current != null)
                $("#update_game_id").focus();
        }

        function reset_delete() {
            $("#delete_id").val('');
            $("#delete_game").html('');
            $("#delete_title").html('');
            $("#delete_value").html('');
            $("#delete_price").html('');
            $("#delete_is_hot").html('');
        }

        // submit form
        $("#form_create").on('submit', function(e) {
            e.preventDefault();
            blockUI.fire();

            $.ajax({
                method: 'POST',
                url: '{{ route('admin.master_voucher.create') }}',
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_create").modal('hide');
                        reset_create(true);
                        table_voucher.ajax.reload();
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
                url: '{{ route('admin.master_voucher.update') }}',
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_update").modal('hide');
                        reset_update();
                        table_voucher.ajax.reload();
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
                url: '{{ route('admin.master_voucher.delete') }}',
                data: $(this).serialize(),
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_delete").modal('hide');
                        table_voucher.ajax.reload();
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

        var table_voucher = $("#table_voucher").DataTable({
            ajax: {
                method: 'POST',
                url: "{{ route('admin.master_voucher.list') }}",
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
                data: 'game_title',
                name: 'game_title',
                searchable: true,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'voucher_title',
                name: 'voucher_title',
                searchable: true,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'voucher_value',
                name: 'voucher_value',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    return `${ float2thousand(data) }`;
                }
            }, {
                data: 'voucher_price',
                name: 'voucher_price',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    return `Rp. ${ float2thousand(data) },-`;
                }
            }, {
                data: 'is_hot',
                name: 'is_hot',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    return data == '1' ?
                        `<small class="badge bg-danger">HOT</small>` :
                        `<small class="badge bg-secondary">Normal</small>`;
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
                            title="Edit voucher ini" data-json="${ encodeURIComponent(JSON.stringify(row)) }"
                            onclick="show_update(this)">
                            <i class="fa fa-pen"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-xs fs-8"
                            title="Hapus voucher ini" data-json="${ encodeURIComponent(JSON.stringify(row)) }"
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
