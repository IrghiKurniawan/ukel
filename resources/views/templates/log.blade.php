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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
    <nav class="bg-green-800 p-2">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="text-white text-lg font-bold">Pengaduan</a>
            <button data-collapse-toggle="navbar-cta" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:text-white dark:focus:ring-gray-600" aria-controls="navbar-cta" aria-expanded="false">
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4 5h12a1 1 0 110 2H4a1 1 0 110-2zM4 11h12a1 1 0 110 2H4a1 1 0 110-2z" clip-rule="evenodd"></path>
                </svg>
            </button>
            <div class="hidden md:flex md:items-center md:w-auto" id="navbar-cta">
                <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
                    <li>
                        <a href="{{ route('logout') }}" class="block py-2 pr-4 pl-3 text-white bg-gray-900 rounded md:bg-transparent md:text-gray-900 md:p-0 dark:text-white md:dark:text-gray-400 md:dark:hover:text-white dark:bg-gray-900 dark:hover:text-white md:dark:hover:bg-transparent">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- yield : mengisi bagian content dinamis/bagian yg akan berubah-ubah di tiap halamannya --}}
    <div id="app">
        @yield('content')
    </div>

    <footer>
        <div class="floating-icons">
            <a href="{{ route('landing_page') }}"><i class="fa fa-user"></i></a>
            <a href="{{ route('kelola_akun.data') }}"><i class="fa fa-exclamation"></i></a>
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
