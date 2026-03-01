@extends('layout.user')

@section('style')
    <style>
        .btn-option:hover {
            border-color: #4e73df;
        }

        .btn-option.active {
            border-color: #4e73df;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <div class="card rounded-5">
            <div class="card-body p-5">
                <div class="row mb-4">
                    <div class="col-md-4 mh-250px">
                        <img class="img-fluid object-fit-cover rounded h-100" src="{{ $game->image }}"
                            alt="{{ $game->title }}">
                    </div>
                    <div class="col-md-8 d-flex align-items-start">
                        <div class="card w-100 h-100">
                            <div class="card-header">
                                <h2 class="card-title text-start fw-bold">{{ $game->title }}</h2>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">
                                    {{ $game->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row mt-3">
                    <div class="col-12 col-md-8 pe-md-3">
                        <div class="mb-4">
                            <h5>Pilih Nominal</h5>
                            <div class="d-flex flex-row flex-wrap rounded border bg-secondary bg-opacity-10 px-1">
                                @if (empty($list_voucher))
                                    <div class="col-md-4 p-2 mx-auto">
                                        <div class="text-center rounded border p-3">
                                            Belum ada list voucher
                                        </div>
                                    </div>
                                @else
                                    @foreach ($list_voucher as $data)
                                        <div class="col-md-4 p-2">
                                            <input type="radio" class="btn-check" name="voucher_value"
                                                id="voucher_value{{ $loop->iteration }}" value="{{ $data->id }}"
                                                autocomplete="off">
                                            <label class="btn btn-outline-primary disabled btn-voucher w-100"
                                                for="voucher_value{{ $loop->iteration }}">
                                                {{ $data->voucher_title }}<br><small>Rp.
                                                    {{ number_format($data->voucher_price, 2, ',', '.') }}</small>
                                            </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="card rounded-4 bg-secondary bg-opacity-10">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="col-3">Game</td>
                                            <td class="col-1">:</td>
                                            <td><b>{{ $game->title }}</b></td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">Nominal</td>
                                            <td class="col-1">:</td>
                                            <td><b id="voucher_value">-</b></td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">Harga</td>
                                            <td class="col-1">:</td>
                                            <td><b id="voucher_price">-</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary w-100" type="button" title="Beli"
                                    @if (auth()->user()) onclick="beli_sekarang();"
                                    @else
                                        onclick="alert('Silakan login terlebih dahulu!')" @endif>
                                    Beli Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('script')
    <script>
        let $voucher = @json($list_voucher);

        $(document).ready(function(){
            $(".btn-voucher.disabled").removeClass('disabled');
        })

        $('input[name="voucher_value"]').on('change', function() {
            var selected = $('input[name="voucher_value"]:checked').val();
            var data = findInObject($voucher, {
                id: selected
            })[0];

            $("#voucher_value").html(float2thousand(data.voucher_value));
            $("#voucher_price").html("Rp. " + float2thousand(data.voucher_price));
        });

        @if (auth()->user())
            function beli_sekarang() {
                var voucher = $('input[name="voucher_value"]:checked').val();
                if (voucher == null || voucher.trim() == '')
                {
                    toastr.errorHtml('Data voucher belum dipilih!');
                    return false;
                }

                blockUI.fire();
                $.ajax({
                    method: 'POST',
                    url: '{{ route('user.payment.create') }}',
                    data: {
                        game: "{{ $game->id }}",
                        voucher: voucher
                    }
                }).done((result) => {
                    if (result.status == 'S') {
                        blockUI.close();

                        toast.timer = 2000;
                        toast.willClose = () => {
                            window.location.href = result.data;
                        }

                        toastr.successHtml(result.message);
                    } else {
                        blockUI.close();
                        toastr.errorHtml(result.message);
                    }
                });
            }
        @endif
    </script>
@endsection
