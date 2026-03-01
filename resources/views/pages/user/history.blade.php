@extends('layout.user')

@section('content')
    <div class="app-content py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <h3 class="fw-bold">Riwayat Pembelian</h3>
                <div class="d-flex flex-row justify-content-between">
                    Riwayat transaksi pembelian saya sebelumnya.
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex flex-column pb-3 gap-3">
        <div class="card">
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table id="table_history" class="table table-bordered table-hover table-striped table-sm">
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
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var table_history = $("#table_history").DataTable({
            ajax: {
                method: 'POST',
                url: "{{ route('user.history.data') }}",
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
