<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .navbar {
            background-color: #007bff;
        }

        .navbar-brand, .nav-link {
            color: #fff !important;
        }

        .content {
            margin-top: 20px;
        }

        .card-header {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Manajemen Kos-Kosan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kamar.index') }}">Kamar</a>
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('penghuni.index') }}">Penghuni</a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('penyewaan.index') }}">Penyewaan</a> --}}
                    </li>
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('pembayaran.index') }}">Pembayaran</a> --}}
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
