@extends('templates.app')

@section('content')
<div class="container min-h-screen flex items-center justify-center py-5">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg">
            <div class="p-6">
                @if (Session::get('failed'))
                    <div class="mb-4 p-4 text-sm text-red-700 bg-red-100 rounded-lg animate-shake">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ Session('failed') }}
                    </div>
                @endif

                <div class="text-center mb-6">
                    <h2 class="text-xl font-bold">Register Dulu</h2>
                    <p class="text-sm text-gray-500">Buat akun </p>
                </div>

                <form action="{{ route('register.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="relative mt-1">
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   class="block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                   placeholder="Create your email" 
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
                                   placeholder="Create your password" 
                                   required>
                            <span class="absolute inset-y-0 right-3 flex items-center cursor-pointer toggle-password">
                                <i class="fas fa-eye text-gray-500"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full py-2 px-4 bg-green-600 text-white font-medium text-sm rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <i class="fas fa-sign-in-alt mr-2"></i>Create Your Account
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
