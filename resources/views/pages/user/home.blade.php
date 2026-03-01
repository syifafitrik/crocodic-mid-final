@extends('layout.user')

@section('style')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            padding-top: 40px;
        }

        #main {
            background-color: #ffffff;
            width: 85%;
            margin: 30px auto;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
        }

        .info-bar {
            background: linear-gradient(90deg, #4e73df, #224abe);
            color: white;
            font-weight: 500;
            padding: 10px 20px;
            font-size: 15px;
        }

        /* Highlight bar */
        .highlight-bar {
            background: linear-gradient(90deg, #36b9cc, #1cc88a);
            color: white;
            border-radius: 12px;
            padding: 12px;
            font-weight: 600;
            margin: 25px auto;
        }

        /* Feature box */
        .feature-box {
            background: #f8f9fc;
            padding: 15px;
            border-radius: 12px;
            font-weight: 600;
        }

        /* Card styling */
        .card-game {
            border-radius: 18px;
            overflow: hidden;
            transition: 0.3s ease;
        }

        .card-game:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection

@section('content')
    <marquee class="info-bar fixed-top" style="top: 80px;" scrollamount="10">
        Melayani 24 Jam Non-Stop • Harga Murah & Terjangkau • Proses Cepat & Aman
    </marquee>

    <div class="container my-5">
        <div class="card rounded-5">
            <div class="card-body p-5">
                <h1 class="text-center fw-bold mb-3">
                    Selamat Datang di Website Top Up Games 🎮
                </h1>
                <p class="text-center text-muted fs-5">
                    Platform top up game terpercaya dengan proses otomatis 24 jam,
                    harga bersaing, dan transaksi aman.
                </p>
                <div class="highlight-bar text-center">
                    Berbagai macam games tersedia di sini! Ayo buruan top up sekarang!
                </div>

                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="card card-game rounded-4 bg-secondary bg-opacity-10 shadow-sm">
                            <div class="card-body fw-semibold">
                                💰 Harga Murah
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-game rounded-4 bg-secondary bg-opacity-10 shadow-sm">
                            <div class="card-body fw-semibold">
                                🔒 Aman & Terjamin
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-game rounded-4 bg-secondary bg-opacity-10 shadow-sm">
                            <div class="card-body fw-semibold">
                                ⭐ Terpercaya
                            </div>
                        </div>
                    </div>
                </div>

                @if (empty($game_list))
                    <div class="row mt-5">
                        <div class="col-4 mx-auto">
                            <div class="card card-game rounded-4 h-100 shadow-md">
                                <img src="{{ asset('assets/images/not-found.jpg') }}" alt="No Game">
                                <div class="card-footer text-center">
                                    <span class="fs-6">Belum ada game ditambahkan.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row justify-content-center mt-5">
                        @foreach ($game_list as $data)
                            <div class="col-12 col-sm-6 col-lg-4 px-2 py-3">
                                <div class="card card-game rounded-4 h-100 shadow-md">
                                    <img class="card-img-top mh-200px object-fit-cover" src="{{ $data->image }}"
                                        alt="{{ $data->title }}">
                                    <div class="card-body text-center">
                                        <h4 class="card-title">{{ $data->title }}</h4>
                                        <p class="card-text">
                                            {{ $data->description }}
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ url("game/$data->id/$data->slug") }}" class="btn btn-primary w-100">Beli
                                            Sekarang</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('components.footer')
@endsection
