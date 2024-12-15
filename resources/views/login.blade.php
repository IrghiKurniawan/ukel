@extends('templates.app')

@section('content')
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            Selamat Datang Ke Halaman Login
        </a>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                   Log in Untuk Masuk
                </h1>
                <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    @if (Session::get('failed'))
                        <div class="bg-red-100 text-red-700 px-4 py-2 rounded">{{ Session::get('failed') }}</div>
                    @endif
                    @if (Session::get('logout'))
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded">{{ Session::get('logout') }}</div>
                    @endif

                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required>
                        @error('email')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••" required>
                        @error('password')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>
                    <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Buat Akun</a>
                    <button type="submit" class="w-full text-black bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                </form>
            </div>
        </div>
    </div>
@endsection