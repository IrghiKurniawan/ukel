<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengaduan App</title>
    {{-- CDN Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
    {{-- asset : memanggil file yg ada di folder public biasanya untuk css,js atau gambar/file tambahan --}}
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="style.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('style')
    <style>
            .floating-icons {
        position: absolute;
        right: 20px;
        bottom: 20px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .floating-icons a {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #1B6F5A;
        color: white;
        text-decoration: none;
        font-size: 20px;
        transition: background-color 0.3s, transform 0.2s;
    }

    .floating-icons a:hover {
        background-color: #155D49;
        transform: scale(1.1);
    }
    </style>
</head>

<body>
    {{-- <nav class="navbar" style="background-color: #e3f2fd;"> 
        <div class="container">
            <a class="navbar-brand" href="#">Pengaduan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                    
                <ul class="navbar-nav">
                    <li class="nav-item">
                        {{-- panggil lewat name href="{{ route('name_routenya') }}" --}}
    {{--  <a class="nav-link"  href="#">Landing</a>
                    </li>      
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">Data Obat</a>
                    </li>
            </div>
        </div>
    </nav>--}

    {{-- yield : mengisi bagian content dinamis/bagian yg akan berubah-ubah di tiap halamannya --}}
    <div id="app">
        @yield('content')
    </div>

    <footer>
        <div class="floating-icons">
            <a href="{{route('landing_page')}}"><i class="fa fa-user"></i></a>
            <a href="{{route('kelola_akun.data')}}"><i class="fa fa-exclamation"></i></a>
            <a href="{{route('report.artikel')}}"><i class="fa fa-pencil"></i></a>
        </div>
    </footer>

    {{-- CDN Bootstrap --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

    {{-- stack : tidak wajib diisi oleh view yg extends nya (optional), kalau yield wajib diisi oleh view extends nya --}}
    @stack('script')
</body>

</html>
