<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Top Up Games</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <!-- Bootstrap -->
    <link href="{{ asset('assets/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            min-height: 100vh;
            padding-top: 110px;
        }

        #main {
            background-color: #ffffff;
            width: 85%;
            margin: 30px auto;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        /* Info bar */
        .info-bar {
            background: linear-gradient(90deg, #4e73df, #224abe);
            color: white;
            text-align: center;
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
        .card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            transition: 0.3s ease;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        footer {
            margin-top: 60px;
            padding: 30px;
            background: #111;
            color: white;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark fixed-top shadow">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                🎮 Top Up Games
            </a>
        </div>
    </nav>

    <!-- Info Bar -->
    <div class="info-bar fixed-top" style="top:56px;">
        Melayani 24 Jam Non-Stop • Harga Murah & Terjangkau • Proses Cepat & Aman
    </div>

    <div id="main">

        <div class="container">

            <!-- Heading -->
            <h1 class="text-center fw-bold mb-3">
                Selamat Datang di Website Top Up Games 🎮
            </h1>

            <p class="text-center text-muted fs-5">
                Platform top up game terpercaya dengan proses otomatis 24 jam,
                harga bersaing, dan transaksi aman.
            </p>

            <!-- Highlight -->
            <div class="highlight-bar text-center">
                Berbagai macam games tersedia di sini! Ayo buruan top up sekarang!
            </div>

            <!-- Features -->
            <div class="row text-center mt-4 g-3">
                <div class="col-md-4">
                    <div class="feature-box shadow-sm">💰 Harga Murah</div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box shadow-sm">🔒 Aman & Terjamin</div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box shadow-sm">⭐ Terpercaya</div>
                </div>
            </div>

            <!-- Cards -->
            <div class="row mt-5 g-4">

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img class="card-img-top" src="{{ asset('assets/images/roblox.png') }}" alt="Roblox">
                        <div class="card-body text-center">
                            <h4 class="card-title">Roblox</h4>
                            <p class="card-text">
                                Top up Robux dengan cepat dan aman.
                            </p>
                            <a href="#" class="btn btn-primary w-100">Get Top Up</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img class="card-img-top" src="{{ asset('assets/images/roblox.png') }}" alt="Game 2">
                        <div class="card-body text-center">
                            <h4 class="card-title">Game 2</h4>
                            <p class="card-text">
                                Top up game favorit kamu dengan harga terbaik.
                            </p>
                            <a href="#" class="btn btn-warning w-100">Get Top Up</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100 shadow-sm">
                        <img class="card-img-top" src="{{ asset('assets/images/roblox.png') }}" alt="Game 3">
                        <div class="card-body text-center">
                            <h4 class="card-title">Game 3</h4>
                            <p class="card-text">
                                Proses cepat, aman, dan terpercaya.
                            </p>
                            <a href="#" class="btn btn-success w-100">Get Top Up</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer>
        &copy; 2026 FitriCompany. All rights reserved.
    </footer>

    <script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>

