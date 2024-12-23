@extends('templates.app')

@section('content')
<div class="container mx-auto py-5">
    <div class="flex justify-center">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <h4 class="text-2xl font-bold text-gray-600 mb-4">Tambah User Baru</h4>
                    <form action="{{ route('user.store') }}" method="POST">
                        @if(Session::get('success'))
                            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <ul class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                                @foreach ($errors->all() as $error)
                                    <li class="ml-2">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @csrf
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Masukan email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="Masukan password" value="{{ old('password') }}">
                        </div>

                        <div class="mb-4">
                            <label for="role" class="block text-sm font-medium text-gray-700">Pilih Role</label>
                            <select name="role" id="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option selected disabled hidden>Role</option>
                                <option value="GUEST" {{ old('role') == 'GUEST' ? 'selected' : '' }}>GUEST</option>
                                <option value="STAFF" {{ old('role') == 'STAFF' ? 'selected' : '' }}>STAFF</option>
                                <option value="HEAD_STAFF" {{ old('role') == 'HEAD_STAFF' ? 'selected' : '' }}>Head Staff</option>
                            </select>
                        </div>

                        <div class="mt-5">
                            <button type="submit" class="w-full px-4 py-2 bg-gray-600 text-white font-semibold rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Tambah Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border: 1px solid #0d6efd;
    }
    
    .form-control, .form-select {
        transition: all 0.3s ease;
    }
    
    .form-control:hover, .form-select:hover {
        background-color: #e9ecef !important;
    }
    
    .btn-primary {
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }
</style>
@endsection