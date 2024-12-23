<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pengaduan App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@1.6.6/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.6/dist/flowbite.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @if (Auth::check())
        <div class="flex h-screen">
            <!-- Sidebar -->
            <aside class="w-64 bg-green-800 h-full">
                <div class="px-6 py-4">
                    <a href="#" class="flex items-center mb-4">
                        <span class="text-xl font-semibold text-white">⚙ Pengaduan App</span>
                    </a>
                    <ul class="space-y-2">
                        @if (Auth::user()->role == 'GUEST')
                            <li>
                                <a href="{{ route('report.index') }}"
                                    class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded">
                                    Daftar Laporan
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('report.monitor') }}"
                                    class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded">
                                    Monitoring
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('report.create') }}"
                                    class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded">
                                   Buat Pengaduan
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'STAFF')
                            <li>
                                <a href="{{ route('response') }}"
                                    class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded">
                                    Response
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role == 'HEAD_STAFF')
                            <li>
                                <a href="{{ route('home.akun') }}"
                                    class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded">
                                    Kelola Akun
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('chart') }}"
                                    class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded">
                                    Chart
                                </a>
                            </li>
                        @endif

                        <li>
                            <a href="{{ route('logout') }}"
                                class="flex items-center p-2 text-gray-300 hover:bg-gray-700 hover:text-white rounded">
                                Logout
                            </a>
                        </li>
                        <li>
                            <a
                                class="flex items-center p-2 text-gray-500 rounded cursor-not-allowed">
                                Disabled
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 p-6">
                @yield('content')
            </div>
        </div>
    @endif
</body>

</html>
