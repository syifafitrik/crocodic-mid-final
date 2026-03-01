@extends('layout.user')

@section('content')
    <div class="app-content py-3">
        <div class="container-fluid">
            <div class="d-flex flex-column">
                <h3 class="fw-bold">Detail Pembelian</h3>
                <div class="d-flex flex-row justify-content-between">
                    Detail voucher yang saya beli.
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid d-flex flex-column pb-3 gap-3">
        <div class="card">
            <div class="card-body p-3">
                <div class="row mb-4">
                    <div class="col-md-4 text-center mh-250px mb-3">
                        <img class="img-fluid object-fit-cover rounded h-100" src="{{ $game->image }}"
                            alt="{{ $game->title }}">
                    </div>
                    <div class="col-md-8 d-flex align-items-start">
                        <div class="card w-100 h-100">
                            <div class="card-header">
                                <h2 class="card-title text-start fw-bold">{{ $voucher->voucher_title }}</h2>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-sm small">
                                    <tbody>
                                        <tr>
                                            <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Game</td>
                                            <td>{{ $game->title }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Nilai Voucher</td>
                                            <td>{{ $payment->voucher_value }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Harga Voucher</td>
                                            <td>Rp. {{ number_format($payment->payment_amount, 2, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Kode Voucher</td>
                                            <td>
                                                @if ($payment->status == 0)
                                                    Menunggu Pembayaran
                                                @elseif ($payment->status == 1)
                                                    {{ $payment->voucher_code }}
                                                @elseif ($payment->status == 2)
                                                    Pembelian Dibatalkan
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Status Pembayaran</td>
                                            <td>
                                                @if ($payment->status == 0)
                                                    <span class="badge bg-secondary">PENDING</span>
                                                @elseif ($payment->status == 1)
                                                    <span class="badge bg-success">SUCCESS</span>
                                                @elseif ($payment->status == 2)
                                                    <span class="badge bg-danger">CANCELED</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div>
                                    @if ($payment->status == 0)
                                        <a type="button" class="btn btn-primary btn-xs fs-8" title="Bayar sekarang"
                                            target="_blank" href="{{ $payment->payment_link ?? '#' }}">
                                            <i class="fa fa-receipt me-1"></i>Bayar Sekarang
                                        </a>
                                        <button type="button" class="btn btn-success btn-xs fs-8"
                                            title="Verifikasi pembayaran" data-bs-toggle="modal" data-bs-target="#modal_verification">
                                            <i class="fa fa-check me-1"></i>Verifikasi Pembayaran
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs fs-8"
                                            title="Batalkan pembayaran" data-bs-toggle="modal" data-bs-target="#modal_cancel">
                                            <i class="fa fa-xmark me-1"></i>Batalkan Pembayaran
                                        </button>
                                    @endif
                                    <a type="button" class="btn btn-secondary btn-xs fs-8" title="Kembali"
                                        href="{{ route('user.payment.index') }}">
                                        <i class="fa fa-circle-left me-1"></i>Kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    @if ($payment->status == '0')
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
                                <td id="verification_title">{{ $game->title }}</td>
                            </tr>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Nilai Voucher</td>
                                <td id="verification_value">{{ $payment->voucher_value }}</td>
                            </tr>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Harga</td>
                                <td id="verification_price">Rp. {{ number_format($payment->payment_amount, 2, ',', '.') }}</td>
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
                                <td id="verification_title">{{ $game->title }}</td>
                            </tr>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Nilai Voucher</td>
                                <td id="verification_value">{{ $payment->voucher_value }}</td>
                            </tr>
                            <tr>
                                <td class="col-3 bg-secondary bg-opacity-10 fw-semibold">Harga</td>
                                <td id="verification_price">Rp. {{ number_format($payment->payment_amount, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <small class="fs-9">
                        <i class="fa-solid fa-exclamation-triangle text-warning me-1"></i>Data yang sudah dibatalkan tidak
                        dapat dikembalikan</small>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" type="button" title="Lakukan pembatalan"
                        onclick="go_cancel();">
                        <span class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-check me-1"></i>
                            Batalkan
                        </span>
                    </button>
                    <button class="btn btn-secondary btn-sm ms-auto" type="button" title="Batal"
                        data-bs-dismiss="modal">
                        <span class="d-flex flex-row align-items-center">
                            <i class="fa-solid fa-xmark me-1"></i>
                            Batal
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('script')
    <script>
        @if ($payment->status == 0)
            function go_verification() {
                blockUI.fire();

                $.ajax({
                    method: 'POST',
                    url: '{{ route('user.payment.verification') }}',
                    data: {
                        payment: '{{ $payment->payment_id }}'
                    },
                    success: function(result, status, xhr) {
                        blockUI.close();

                        if (result.status == "S") {
                            $("#modal_verification").modal('hide');

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
            }

            function go_cancel() {
                blockUI.fire();

                $.ajax({
                    method: 'POST',
                    url: '{{ route('user.payment.cancel') }}',
                    data: {
                        payment: '{{ $payment->payment_id }}'
                    },
                    success: function(result, status, xhr) {
                        blockUI.close();

                        if (result.status == "S") {
                            $("#modal_cancel").modal('hide');
                            
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
            }
        @endif
    </script>
@endsection

@section('footer')
    @include('components.footer')
@endsection
