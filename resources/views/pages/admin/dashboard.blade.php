@extends('layout.admin')

@section('content')
    <div class="container-fluid d-flex flex-column gap-3 py-3">
        <div class="card col">
            <div class="card-body p-2">
                <div class="d-flex flex-md-row flex-column gap-2 mb-1">
                    <div class="col">
                        <div class="d-flex flex-column text-center p-2 border rounded">
                            <span class="fs-3 fw-semibold" id="monthly_income">Rp. 0,-</span>
                            <span>Total Pendapatan Bulan Ini</span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="d-flex flex-column text-center p-2 border rounded">
                            <span class="fs-3 fw-semibold" id="last_income">Rp. 0,-</span>
                            <span>Total Pendapatan Bulan Lalu</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex flex-md-row flex-column gap-2 mb-1">
            <div class="card col">
                <div class="card-body p-2">
                    <div class="d-flex flex-column text-center p-2 border rounded">
                        <span class="fs-3 fw-semibold" id="today_income">Rp. 0,-</span>
                        <span>Total Pendapatan di Hari Ini</span>
                    </div>
                    <div>
                        <table class="w-100 mt-1">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="card bg-primary text-white">
                                            <div class="card-body d-flex flex-column text-center p-2">
                                                <span class="fs-4 fw-semibold" id="today_all">0</span>
                                                <small>Total Semua Transaksi di Hari Ini</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="card bg-success text-white">
                                            <div class="card-body d-flex flex-column text-center p-2">
                                                <span class="fs-4 fw-semibold" id="today_success">0</span>
                                                <small>Transaksi Berhasil di Hari Ini</small>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="card bg-secondary text-white">
                                            <div class="card-body d-flex flex-column text-center p-2">
                                                <span class="fs-4 fw-semibold" id="today_pending">0</span>
                                                <small>Transaksi Pending di Hari Ini</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="card bg-danger text-white">
                                            <div class="card-body d-flex flex-column text-center p-2">
                                                <span class="fs-4 fw-semibold" id="today_cancel">0</span>
                                                <small>Transaksi Dibatalkan di Hari Ini</small>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card col">
                <div class="card-body p-2">
                    <div class="d-flex flex-column text-center p-2 border rounded">
                        <span class="fs-3 fw-semibold" id="yesterday_income">Rp. 0,-</span>
                        <span>Total Pendapatan Kemarin</span>
                    </div>
                    <div>
                        <table class="w-100 mt-1">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="card bg-primary text-white">
                                            <div class="card-body d-flex flex-column text-center p-2">
                                                <span class="fs-4 fw-semibold" id="yesterday_all">0</span>
                                                <small>Total Semua Transaksi Kemarin</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="card bg-success text-white">
                                            <div class="card-body d-flex flex-column text-center p-2">
                                                <span class="fs-4 fw-semibold" id="yesterday_success">0</span>
                                                <small>Transaksi Berhasil Kemarin</small>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="card bg-secondary text-white">
                                            <div class="card-body d-flex flex-column text-center p-2">
                                                <span class="fs-4 fw-semibold" id="yesterday_pending">0</span>
                                                <small>Transaksi Pending Kemarin</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="card bg-danger text-white">
                                            <div class="card-body d-flex flex-column text-center p-2">
                                                <span class="fs-4 fw-semibold" id="yesterday_cancel">0</span>
                                                <small>Transaksi Dibatalkan Kemarin</small>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            fetch_data();
            setInterval(fetch_data, 60000);
        })

        function fetch_data() {
            $.ajax({
                url: '{{ route('admin.dashboard.data') }}',
                type: 'POST',
                success: function(result, status, xhr) {
                    if (result.status == "S") {
                        // toastr.success(result.message);

                        $('#today_all').html(result.data.today_all);
                        $('#today_pending').html(result.data.today_pending);
                        $('#today_success').html(result.data.today_success);
                        $('#today_cancel').html(result.data.today_cancel);
                        $('#yesterday_all').html(result.data.yesterday_all);
                        $('#yesterday_pending').html(result.data.yesterday_pending);
                        $('#yesterday_success').html(result.data.yesterday_success);
                        $('#yesterday_cancel').html(result.data.yesterday_cancel);

                        var $today_income = float2thousand(result.data.today_income);
                        var $yesterday_income = float2thousand(result.data.yesterday_income);
                        var $monthly_income = float2thousand(result.data.monthly_income);
                        var $last_income = float2thousand(result.data.last_income);

                        $('#today_income').html('Rp. ' + $today_income + ',-');
                        $('#yesterday_income').html('Rp. ' + $yesterday_income + ',-');
                        $('#monthly_income').html('Rp. ' + $monthly_income + ',-');
                        $('#last_income').html('Rp. ' + $last_income + ',-');
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
    </script>
@endsection
