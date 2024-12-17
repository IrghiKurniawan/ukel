@extends('templates.log')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Daftar Laporan Pengaduan</h1>

    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel untuk menampilkan data pengaduan -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
            <thead class="bg-green-800 text-white">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">User</th>
                    <th class="px-4 py-2">Provinsi</th>
                    <th class="px-4 py-2">Kabupaten</th>
                    <th class="px-4 py-2">Kecamatan</th>
                    <th class="px-4 py-2">Desa</th>
                    <th class="px-4 py-2">Tipe</th>
                    <th class="px-4 py-2">Deskripsi</th>
                    <th class="px-4 py-2">Gambar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $index => $report)
                <tr class="border-b hover:bg-green-100">
                    <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">{{ $report->users->name }}</td>
                    <td class="px-4 py-2">{{ $report->province }}</td>
                    <td class="px-4 py-2">{{ $report->regency }}</td>
                    <td class="px-4 py-2">{{ $report->subdistrict }}</td>
                    <td class="px-4 py-2">{{ $report->village }}</td>
                    <td class="px-4 py-2">{{ $report->type }}</td>
                    <td class="px-4 py-2">{{ $report->description }}</td>
                    <td class="px-4 py-2">
                        @if ($report->image)
                            <img src="{{ asset('storage/' . $report->image) }}" alt="Report Image" class="w-24 h-24 rounded-lg object-cover">
                        @else
                            <span class="text-gray-500">Tidak ada gambar</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection