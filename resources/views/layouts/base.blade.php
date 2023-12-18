<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} - Test Venturo</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container-fluid my-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="card-title mb-0">Venturo - Laporan Penjualan Tahunan Per Menu</h6>
            </div>
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>