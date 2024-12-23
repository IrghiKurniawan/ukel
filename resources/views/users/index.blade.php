@extends('templates.app')

@section('content')

@if(Session::get('success'))
<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
    {{ Session::get('success') }}
</div>
@endif
@if(Session::get('deleted'))
<div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
    {{ Session::get('deleted') }}
</div>
@endif

<div class="container mx-auto mt-5">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <h3 class="text-lg font-semibold">Daftar Akun</h3>
        <div class="bg-white-600 p-4">
            <form class="flex" action="{{ route('home.akun') }}" role="search" method="GET">
                <input type="search" name="search" aria-label="Search" class="form-input w-full rounded-md border-gray-300" placeholder="Cari Users">
                <button class="ml-2 px-4 py-2 bg-gray text-black border border-green rounded-md" type="submit">
                    Search
                </button>
            </form>
        </div>
        <div class="p-4">
            <a href="{{ route('user.create') }}" class="inline-block mb-3 px-4 py-2 bg-gray-600 text-green rounded-md">Tambah Akun</a>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-green-800 text-white">
                        <tr>
                            <th class="w-1/12 px-4 py-2">#</th>
                            <th class="w-3/12 px-4 py-2">Email</th>
                            <th class="w-3/12 px-4 py-2">Password</th>
                            <th class="w-2/12 px-4 py-2">Role</th>
                            <th class="w-3/12 px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @php $no = 1; @endphp
                        @foreach($users as $index => $user)
                        <tr>
                            <td class="border px-4 py-2">{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $user['email'] }}</td>
                            <td class="border px-4 py-2">{{ $user['password'] }}</td>
                            <td class="border px-4 py-2">{{ $user['role'] }}</td>
                            <td class="border px-4 py-2 text-center">
                                <form action="{{route('user.reset' , $user['id'])}}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2 py-1 bg-green-500 text-white rounded-md"><i class="fas fa-edit"></i> Reset</button>
                                </form>
                                <button class="px-2 py-1 bg-gray-500 text-white rounded-md" onclick="showModalDelete({{ $user['id'] }}, '{{ $user['name'] }}')"><i class="fas fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

<div id="ModalDeleteUser" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
    <div class="relative w-full h-full max-w-md md:h-auto">
        <form id="form-delete-user" method="POST" class="relative bg-white rounded-lg shadow">
            @csrf
            @method('DELETE')
            <div class="p-6 text-center">
                <h3 class="mb-5 text-lg font-normal text-gray-500">Hapus Data User</h3>
                <p>Apakah Anda yakin ingin menghapus data User <span id="nama-user" class="font-bold"></span>?</p>
                <div class="flex justify-center mt-4">
                    <button type="button" class="text-gray-500 bg-white border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg text-sm px-5 py-2.5 mr-2" data-modal-hide="ModalDeleteUser">Tutup</button>
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script>
    function showModalDelete(id, name) {
        let action = '{{route('user.delete', ':id')}}';
        action = action.replace(':id', id);
        $('#form-delete-user').attr('action', action);
        $('#ModalDeleteUser').removeClass('hidden');
        $('#nama-user').text(name);
    }

    $(document).on('click', '[data-modal-hide]', function() {
        $(this).closest('.modal').addClass('hidden');
    });
</script>
@endpush

@endsection
