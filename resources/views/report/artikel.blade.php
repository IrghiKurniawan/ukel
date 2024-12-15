@extends('templates.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
    <div class="col-span-2">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4">
            <select class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option selected>Pilih</option>
            </select>
            <button class="mt-2 w-full px-4 py-2 text-green bg-green-800 hover:bg-green-900 rounded-lg focus:outline-none focus:ring-4 focus:ring-gray-300">Cari</button>
        </div>

        @foreach ($reports as $report)
        <div class="bg-white border rounded-lg shadow-md p-4 flex mb-4">
            <img src="{{ asset('storage/' . $report->image) }}" alt="Article Image" class="w-24 h-24 rounded-lg mr-4">
            <div>
                <h5 class="text-lg font-bold">{{ $report->title }}</h5>
                <div class="text-sm text-gray-500 space-x-2 mt-2">
                    <span><i class="fa fa-eye"></i> {{ $report->views }}</span>
                    <span><i class="fa fa-heart"></i> {{ $report->likes }}</span>
                    <span>{{ $report->user->email }}</span>
                    <span>{{ $report->created_at ? $report->created_at->diffForHumans() : 'Tanggal tidak tersedia' }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="bg-white border rounded-lg shadow-md p-6">
        <h5 class="text-xl font-bold mb-4">Informasi Pembuatan Pengaduan</h5>
        <ul class="list-disc pl-5 text-gray-700 space-y-2">
            <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
            <li>Keseluruhan data pada pengaduan bernilai BENAR dan DAPAT DIPERTANGGUNG JAWABKAN.</li>
            <li>Seluruh bagian data perlu diisi.</li>
            <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>
            <li>Periksa tanggapan Kami, pada Dashboard setelah Anda Login.</li>
            <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="{{route('report.create_report')}}" class="text-blue-600 hover:underline">Ikuti Tautan</a>.</li>
        </ul>
    </div>
</div>
@endsection
