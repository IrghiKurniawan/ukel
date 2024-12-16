@extends('templates.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
    <div class="col-span-2">
        @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('report.artikel') }}" method="GET">
            <div class="search-bar">
                <select id="province" name="province"class="form-control">
                    <option value="" disabled selected >Memuat data...</option>
                </select>
                <button type="submit" class="btn btn-dark mt-2 ">Cari</button>
            </div>
        </form>

        @foreach ($reports as $report)
        <div class="bg-white border rounded-lg shadow-md p-4 flex mb-4">
            <img src="{{ asset('storage/' . $report->image) }}" alt="Article Image" class="w-24 h-24 rounded-lg mr-4">
            <div>
                <h5 class="text-lg font-bold">{{ $report->title }}</h5>
                <div class="text-sm text-gray-500 space-x-2 mt-2">
                    <span><i class="fa fa-eye"></i> {{ $report->views }}</span>
                    <span><i class="fa fa-heart"></i> {{ $report->likes }}</span>
                    <span>{{ $report->user->email }}</span>
                    <span>{{ $report->province }}</span>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        const apiEndpoint = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";

        $.getJSON(apiEndpoint, function (data) {
            const provinceDropdown = $("#province");
            provinceDropdown.empty();
            provinceDropdown.append('<option value="" disabled selected>Pilih Provinsi</option>');
            
            $.each(data, function (index, province) {
                provinceDropdown.append(`<option value="${province.id}">${province.name}</option>`); // Backticks digunakan
            });
        }).fail(function () {
            alert("Gagal memuat data provinsi. Silakan coba lagi.");
            $("#province").empty().append('<option value="" disabled selected>Gagal memuat data</option>');
        });
    });
</script>


@endsection
