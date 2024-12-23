<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengaduan App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.6/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.6/dist/flowbite.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.6/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.6/dist/flowbite.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- @if (Auth::check())
        <nav class="bg-green-800 border-gray-200 px-4 lg:px-6 py-2.5">
            <div class="container flex flex-wrap justify-between items-center mx-auto">
                <a href="#" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap text-white">⚙ Pengaduan App</span>
                </a>
                <button data-collapse-toggle="navbar-default" type="button"
                    class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                    aria-controls="navbar-default" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
                <div class="hidden w-full lg:block lg:w-auto" id="navbar-default">
                    <ul class="flex flex-col lg:flex-row lg:space-x-8 mt-4 lg:mt-0 text-sm font-medium">
                        @if (Auth::user()->role == 'GUEST')
                            {{-- <li>
                                <a href="{{ url('/') }}"
                                    class="block py-2 pr-4 pl-3 text-white rounded lg:bg-transparent lg:text-white lg:p-0">Home</a>
                            </li> --}}
                            {{-- <li>
                                <a href="{{ route('report.index') }}"
                                    class="block py-2 pr-4 pl-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded lg:hover:bg-transparent lg:hover:text-white lg:p-0">Daftar
                                    Laporan</a>
                            </li>
                            <li>
                                <a href="{{ route('report.monitor') }}"
                                    class="block py-2 pr-4 pl-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded lg:hover:bg-transparent lg:hover:text-white lg:p-0">Monitoring</a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'STAFF')
                            <li>
                                <a href="{{ route('response') }}"
                                    class="block py-2 pr-4 pl-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded lg:hover:bg-transparent lg:hover:text-white lg:p-0">Response</a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'HEAD_STAFF')
                            <li>
                                <a href="{{ route('home.akun') }}"
                                    class="block py-2 pr-4 pl-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded lg:hover:bg-transparent lg:hover:text-white lg:p-0">Kelola
                                    Akun</a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('logout') }}"
                                class="block py-2 pr-4 pl-3 text-gray-300 hover:bg-gray-700 hover:text-white rounded lg:hover:bg-transparent lg:hover:text-white lg:p-0">Logout</a>
                        </li>
                        <li>
                            <a
                                class="block py-2 pr-4 pl-3 text-gray-500 rounded lg:bg-transparent lg:text-gray-500 lg:p-0 cursor-not-allowed">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @endif --}} 

    <div class="container mt-5">
        @yield('content')
    </div>

</body>

</html>
