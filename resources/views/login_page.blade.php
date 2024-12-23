@extends('templates.appp')

@section('content')
<div class="container min-h-screen flex items-center justify-center py-5">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6">
               
                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold">Selamat Datang Di Halaman Login!</h2>
                </div>

                <form action="{{ route('loginAuth') }}" method="POST" class="space-y-4">
                    @csrf
                    @if (Session::get('failed'))
                        <div class="bg-red-100 text-red-700 px-4 py-2 rounded">{{ Session::get('failed') }}</div>
                    @endif
                    @if (Session::get('logout'))
                        <div class="bg-green-100 text-green-700 px-4 py-2 rounded">{{ Session::get('logout') }}</div>
                    @endif
                    @if (Session::get('canAccess'))
                        <div class="bg-red-100 text-red-700 px-4 py-2 rounded">{{Session::get('canAccess')}}</div>
                    @endif
    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="relative mt-1">
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                   placeholder="Enter your email" 
                                   required>
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="relative mt-1">
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                   placeholder="Enter your password" 
                                   required>
                            </span>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full py-2 px-4 bg-green-600 text-white font-medium text-sm rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Login
                    </button>

                    <p class="text-center text-sm text-gray-500 mt-4">
                        sini buat akun dulu 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Buat akun</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
