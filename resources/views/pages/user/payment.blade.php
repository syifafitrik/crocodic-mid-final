@extends('layout.user')

@section('content')
    <div class="app-content py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <h3 class="fw-bold">Pembelian Saya</h3>
                <div class="d-flex flex-row justify-content-between">
                    Semua voucher yang sudah saya beli.
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex flex-column pb-3 gap-3">
        <div class="card">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="table_payment" class="table table-bordered table-hover table-striped table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Judul Game</th>
                                <th>Judul Voucher</th>
                                <th>Nilai Voucher</th>
                                <th>Harga Voucher</th>
                                <th>Status</th>
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
    <div class="modal fade" id="modal_verification" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modal_verificationTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <span class="modal-title fs-5 d-flex flex-row align-items-center" id="modal_verificationTitle">
                        <i class="fa-solid fa-circle-check text-white me-1"></i>Verifikasi
                    </span>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        Anda yakin ingin verifikasi pembelian voucher dengan data berikut?
                    </p>
                    <table class="table table-bordered table-sm mb-1 small">
                        <tbody>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Judul Game</td>
                                <td id="verification_title"></td>
                            </tr>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Nilai Voucher</td>
                                <td id="verification_value"></td>
                            </tr>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Harga</td>
                                <td id="verification_price"></td>
                            </tr>
                        </tbody>
                    </table>
                    <small class="fs-9">
                        <i class="fa-solid fa-exclamation-triangle text-warning me-1"></i>Pastikan sudah melakukan
                        pembayaran sebelum melakukan verifikasi</small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success btn-sm" type="button" title="Lakukan verifikasi"
                        onclick="go_verification();">
                        <span class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-check me-1"></i>
                            Verifikasi
                        </span>
                    </button>
                    <button class="btn btn-secondary btn-sm ms-auto" type="button" title="Batal" data-bs-dismiss="modal">
                        <span class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-xmark me-1"></i>
                            Batal
                        </span>
                    </button>
                    <input type="hidden" id="verification_id" name="id">
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal_cancel" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modal_cancelTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <span class="modal-title fs-5 d-flex flex-row align-items-center" id="modal_cancelTitle">
                        <i class="fa-solid fa-circle-xmark text-white me-1"></i>Batalkan Pembelian
                    </span>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        Anda yakin ingin membatalkan pembelian voucher dengan data berikut?
                    </p>
                    <table class="table table-bordered table-sm mb-1 small">
                        <tbody>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Judul Game</td>
                                <td id="cancel_title"></td>
                            </tr>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Nilai Voucher</td>
                                <td id="cancel_value"></td>
                            </tr>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Harga</td>
                                <td id="cancel_price"></td>
                            </tr>
                        </tbody>
                    </table>
                    <small class="fs-9">
                        <i class="fa-solid fa-exclamation-triangle text-warning me-1"></i>Data yang sudah dibatalkan tidak
                        dapat dikembalikan</small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" type="button" title="Lakukan pembatalan" onclick="go_cancel();">
                        <span class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-check me-1"></i>
                            Batalkan
                        </span>
                    </button>
                    <button class="btn btn-secondary btn-sm ms-auto" type="button" title="Batal" data-bs-dismiss="modal">
                        <span class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-xmark me-1"></i>
                            Batal
                        </span>
                    </button>
                    <input type="hidden" id="cancel_id" name="id">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function show_verification(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));

            $("#verification_id").val(data.payment_id);
            $("#verification_title").html(data.game_title);
            $("#verification_value").html(data.voucher_value);
            $("#verification_price").html("Rp. " + float2thousand(data.payment_amount));

            $("#modal_verification").modal('show');
        }

        function show_cancel(e) {
            var data = JSON.parse(decodeURIComponent($(e).data('json')));

            $("#cancel_id").val(data.payment_id);
            $("#cancel_title").html(data.game_title);
            $("#cancel_value").html(data.voucher_value);
            $("#cancel_price").html("Rp. " + float2thousand(data.payment_amount));

            $("#modal_cancel").modal('show');
        }

        function reset_verification() {
            $("#verification_id").val('');
            $("#verification_title").html('');
            $("#verification_value").html('');
            $("#verification_price").html('Rp. -');
        }

        function reset_cancel() {
            $("#cancel_id").val('');
            $("#cancel_title").html('');
            $("#cancel_value").html('');
            $("#cancel_price").html('Rp. -');
        }

        function go_verification() {
            blockUI.fire();

            var data_id = $("#verification_id").val();

            $.ajax({
                method: 'POST',
                url: '{{ route('user.payment.verification') }}',
                data: {
                    payment: data_id
                },
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_verification").modal('hide');
                        reset_verification();
                        table_payment.ajax.reload();
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function(result, status, xhr) {
                    blockUI.close();
                    toastr.error(result.message);
                }
            });
        }

        function go_cancel() {
            blockUI.fire();

            var data_id = $("#cancel_id").val();

            $.ajax({
                method: 'POST',
                url: '{{ route('user.payment.cancel') }}',
                data: {
                    payment: data_id
                },
                success: function(result, status, xhr) {
                    blockUI.close();

                    if (result.status == "S") {
                        toastr.success(result.message);

                        $("#modal_cancel").modal('hide');
                        reset_cancel();
                        table_payment.ajax.reload();
                    } else {
                        toastr.error(result.message);
                    }
                },
                error: function(result, status, xhr) {
                    blockUI.close();
                    toastr.error(result.message);
                }
            });
        }

        var table_payment = $("#table_payment").DataTable({
            ajax: {
                method: 'POST',
                url: "{{ route('user.payment.list') }}",
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
                searchable: true,
                orderable: true,
                type: 'string',
                defaultContent: '-',
            }, {
                data: 'payment_amount',
                name: 'payment_amount',
                searchable: true,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    return data ? "Rp. " + float2thousand(data) : '-'
                }
            }, {
                data: 'status',
                name: 'status',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    if (data == 0 || data == '0')
                        return `<span class="badge bg-secondary">Pending</span>`;
                    else if (data == 1 || data == '1')
                        return `<span class="badge bg-success">Success</span>`;
                    else if (data == 2 || data == '2')
                        return `<span class="badge bg-danger">Canceled</span>`;
                    else
                        return `<span class="badge bg-light">Unknown</span>`;
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
                data: 'payment_id',
                name: 'payment_id',
                searchable: false,
                orderable: true,
                type: 'string',
                defaultContent: '-',
                render: function(data, type, row, meta) {
                    var $btn_detail = 
                        `<a type="button" class="btn btn-primary btn-xs fs-8"
                            title="Lihat detail pembayaran"
                            href="{{ route('user.payment.detail') }}/${data}">
                            <i class="fa fa-eye"></i>
                        </a>`;
                    var $btn_bayar = row.status == '0' ? `
                        <a type="button" class="btn btn-warning btn-xs fs-8"
                            title="Bayar sekarang" target="_blank"
                            href="${ row.payment_link ?? '#' }">
                            <i class="fa fa-receipt"></i>
                        </a>` : '';
                    var $btn_verification = row.status == '0' ? `
                        <button type="button" class="btn btn-success btn-xs fs-8"
                            title="Verifikasi pembayaran" data-json="${ encodeURIComponent(JSON.stringify(row)) }"
                            onclick="show_verification(this)">
                            <i class="fa fa-check"></i>
                        </button>` : '';
                    var $btn_cancel = row.status == '0' ? `
                        <button type="button" class="btn btn-danger btn-xs fs-8"
                            title="Batalkan pembayaran" data-json="${ encodeURIComponent(JSON.stringify(row)) }"
                            onclick="show_cancel(this)">
                            <i class="fa fa-xmark"></i>
                        </button>
                        ` : '';

                    return `
                    <div class="text-nowrap">
                            ${$btn_detail}
                            ${$btn_bayar}
                            ${$btn_verification}
                            ${$btn_cancel}
                        </div>
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

@section('footer')
    @include('components.footer')
@endsection
