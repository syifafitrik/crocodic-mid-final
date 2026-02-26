<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Top Up Roblox</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700">

    <!-- Bootstrap -->
    <link href="{{ asset('assets/plugins/bootstrap/bootstrap.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            padding-top: 80px;
        }

        .container-box {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }

        .game-header img {
            width: 100%;
            max-height: 250px;
            object-fit: cover;
            border-radius: 15px;
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .option-box {
            border: 2px solid #eee;
            border-radius: 12px;
            padding: 15px;
            cursor: pointer;
            transition: 0.3s;
            text-align: center;
            font-weight: 500;
        }

        .option-box:hover {
            border-color: #4e73df;
            background: #f8f9ff;
        }

        .option-box.active {
            border-color: #4e73df;
            background: #e8f0ff;
        }

        .summary-box {
            background: #f8f9fc;
            border-radius: 15px;
            padding: 20px;
        }

        .btn-buy {
            background: linear-gradient(90deg, #4e73df, #224abe);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-buy:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            🎮 Top Up Games
        </a>
    </div>
</nav>

<div class="container mt-5 mb-5">
    <div class="container-box">

        <!-- Header Game -->
        <div class="row mb-4">
            <div class="col-md-4 game-header">
                <img src="{{ asset('assets/images/roblox.png') }}" alt="Roblox">
            </div>
            <div class="col-md-8 d-flex align-items-center">
                <div>
                    <h2 class="fw-bold">Top Up Roblox (Robux)</h2>
                    <p class="text-muted">
                        Isi Robux dengan cepat dan aman. Masukkan User ID Roblox kamu dan pilih nominal yang tersedia.
                    </p>
                </div>
            </div>
        </div>

        <div class="row">

            <!-- LEFT SIDE -->
            <div class="col-lg-8">

                <!-- Input User ID -->
                <div class="mb-4">
                    <h5 class="section-title">1. Masukkan User ID</h5>
                    <input type="text" class="form-control" placeholder="Masukkan User ID Roblox">
                </div>

                <!-- Pilih Nominal -->
                <div class="mb-4">
                    <h5 class="section-title">2. Pilih Nominal</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="option-box">80 Robux<br><small>Rp 15.000</small></div>
                        </div>
                        <div class="col-md-4">
                            <div class="option-box">400 Robux<br><small>Rp 65.000</small></div>
                        </div>
                        <div class="col-md-4">
                            <div class="option-box">800 Robux<br><small>Rp 120.000</small></div>
                        </div>
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-4">
                    <h5 class="section-title">3. Pilih Metode Pembayaran</h5>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="option-box">DANA</div>
                        </div>
                        <div class="col-md-4">
                            <div class="option-box">OVO</div>
                        </div>
                        <div class="col-md-4">
                            <div class="option-box">Bank Transfer</div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT SIDE (SUMMARY) -->
            <div class="col-lg-4">
                <div class="summary-box">
                    <h5 class="fw-bold mb-3">Ringkasan Pesanan</h5>
                    <p>Game: <strong>Roblox</strong></p>
                    <p>Nominal: <strong>-</strong></p>
                    <p>Harga: <strong>-</strong></p>
                    <hr>
                    <button class="btn-buy w-100">
                        Beli Sekarang
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>

<script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js') }}"></script>

<script>
    // Simple select effect
    document.querySelectorAll('.option-box').forEach(box => {
        box.addEventListener('click', function () {
            this.parentElement.parentElement.querySelectorAll('.option-box')
                .forEach(el => el.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>
</html>