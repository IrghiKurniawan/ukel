@extends('templates.app')

@section('content')
    <div class="container mt-8">
        <div class="d-flex justify-content-end">
            <form class="d-flex me-3" action="{{ route('kelola_akun.data') }}" method="GET">
                {{-- Form pencarian akun --}}
                <input type="text" name="cari" placeholder="Cari Nama Akun..." class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                
                <button type="submit" class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Cari</button>
            </form>
            {{-- Tombol tambah akun --}}
            <a href="{{ route('kelola_akun.tambah') }}" class="ext-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Tambah Akun</a>
        </div>
        <br>
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <table class="w-full text-sm text-left rtl:text-right text-black-500 dark:text-black-400 border-collapse border border-gray-300">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <th class="px-5 py-3 border border-gray-300">No</th>
                <th class="px-5 py-3 border border-gray-300">Nama</th>
                <th class="px-5 py-3 border border-gray-300">Email</th>
                <th class="px-5 py-3 border border-gray-300">Role</th>
                <th class="px-5 py-3 border border-gray-300">Aksi</th>
            </thead>
            <tbody>
                {{-- jika data akun kosong --}}
                @if (count($users) == 0)
                    <tr class="bg-gray-100">
                        <td colspan="5" class="text-center border border-gray-300 py-2">Data Akun Kosong</td>
                    </tr>
                @else
                    {{-- Loop data akun dari controller --}}
                    @foreach ($users as $index => $item)
                        <tr class="bg-gray-50 hover:bg-gray-100">
                            <td class="border border-gray-300 px-5 py-2">{{ ($users->currentPage() - 1) * $users->perpage() + ($index + 1) }}</td>
                            <td class="border border-gray-300 px-5 py-2">{{ $item['name'] }}</td>
                            <td class="border border-gray-300 px-5 py-2">{{ $item['email'] }}</td>
                            <td class="border border-gray-300 px-5 py-2">{{ $item['role'] }}</td>
                            <td class="border border-gray-300 px-5 py-2">
                                <div class="flex gap-4 justify-center"> 
                                    <a href="{{ route('kelola_akun.ubah', $item['id']) }}"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    <button class="font-medium text-red-600 dark:text-red-500 hover:underline"
                                        onclick="showModalDelete('{{ $item->id }}','{{ $item->name }}')">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        

        {{-- memanggil pagination --}}
        <div class="d-flex justify-content-end my-3">
            {{ $users->links() }}
        </div>

        <!-- Modal Hapus Akun -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="modal-content" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">HAPUS AKUN</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus akun <b id="nama_akun"></b>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="floating-icons">
        <a href="{{ route('landing_page') }}"><i class="fa fa-user"></i></a>
        <a href="{{ route('kelola_akun.data') }}"><i class="fa fa-exclamation"></i></a>
        <a href="#"><i class="fa fa-pencil"></i></a>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        function showModalDelete(id, name) {
            $('#nama_akun').text(name);
            $('#exampleModal').modal('show');
            let url = "{{ route('kelola_akun.hapus', ':id') }}";
            url = url.replace(':id', id);
            $("form").attr('action', url);
        }
    </script>
@endpush
