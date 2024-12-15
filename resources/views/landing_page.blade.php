    @extends('templates.app')

    @section('content')

    <div class="container flex flex-col md:flex-row items-center justify-center px-6 py-8 mx-auto space-y-6 md:space-y-0 md:space-x-6">
        <div class="text-center md:text-left max-w-lg">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Pengaduan Masyarakat</h1>
            <p class="text-gray-700 dark:text-gray-400 mb-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi perspiciatis aut pariatur doloremque labor obcaecati dicta accusantium delectus asperiores illum minima veritatis iure quidem amet rerum fugit quaerat illo!</p>
            <a href="{{ route('login') }}" class="px-5 py-2.5 text-black bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm">Bergabung!</a>
        </div>
        <div class="flex-shrink-0">
            <img class="w-full max-w-md rounded-lg shadow-lg" src="images/background.jpg" alt="Pengaduan Masyarakat">
        </div>
    </div>

    {{-- Floating icons section --}}
    <div class="fixed bottom-5 right-5 flex flex-col space-y-3">
        <a href="{{ route('landing_page') }}" class="flex items-center justify-center w-12 h-12 bg-primary-600 text-white rounded-full shadow-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">
            <i class="fa fa-user text-lg"></i>
        </a>
        <a href="{{ route('kelola_akun.data') }}" class="flex items-center justify-center w-12 h-12 bg-primary-600 text-white rounded-full shadow-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">
            <i class="fa fa-exclamation text-lg"></i>
        </a>
        <a href="#" class="flex items-center justify-center w-12 h-12 bg-primary-600 text-white rounded-full shadow-lg hover:bg-primary-700 focus:ring-4 focus:ring-primary-300">
            <i class="fa fa-pencil text-lg"></i>
        </a>
    </div>

    @endsection
