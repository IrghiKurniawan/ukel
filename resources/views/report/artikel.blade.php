@extends('templates.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 p-6">
        <!-- Bagian Utama -->
        <div class="col-span-2 space-y-6">
            @if (session('success'))
                <div class="p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Form Pencarian -->
            <form action="{{ route('report.artikel') }}" method="GET" class="space-y-4">
                <div>
                    <label for="province" class="block text-sm font-medium text-gray-700">Pilih Provinsi</label>
                    <select id="province" name="province"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="" disabled selected>Memuat data...</option>
                    </select>
                </div>
                <button type="submit"
                    class="w-full bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-blue-600 focus:ring focus:ring-blue-300 focus:ring-offset-2">
                    Cari
                </button>
            </form>

            <!-- Daftar Artikel -->
            @foreach ($reports as $report)
                <div
                    class="flex items-start bg-white shadow-md rounded-lg p-4 border border-gray-200 hover:shadow-lg transition">
                    <div class="flex-shrink-0">
                        <img src="{{ $report->image ? asset('storage/' . $report->image) : asset('default-image.jpg') }}"
                            alt="Report Image"
                            class="w-24 h-24 rounded-lg object-cover border border-gray-300">
                    </div>
                    <div class="ml-4">
                        <h5 class="text-lg font-semibold text-gray-800">{{ $report->type }}</h5>
                        <p class="text-sm text-gray-600">{{ $report->description }}</p>
                        <div class="flex items-center space-x-3 text-sm text-gray-500 mt-2">
                            <span><i class="fa fa-eye mr-1"></i>{{ $report->viewers }}</span>
                            <span><i class="fa fa-heart mr-1"></i>0 Likes</span>
                            <span>{{ $report->created_at->diffForHumans() }}</span>
                        </div>
                        <a href="{{ route('report.detail', $report->id) }}"
                            class="inline-block mt-3 text-blue-500 hover:underline font-medium">
                            Lihat Detail &rarr;
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Informasi Pengaduan -->
        <div class="bg-white border border-gray-200 shadow-md rounded-lg p-6 space-y-4">
            <h5 class="text-xl font-semibold text-gray-800">Informasi Pembuatan Pengaduan</h5>
            <ul class="list-disc pl-5 space-y-2 text-gray-700">
                <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                <li>Keseluruhan data pada pengaduan bernilai BENAR dan DAPAT DIPERTANGGUNG JAWABKAN.</li>
                <li>Seluruh bagian data perlu diisi.</li>
                <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>
                <li>Periksa tanggapan Kami, pada Dashboard setelah Anda Login.</li>
                <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: 
                    <a href="{{ route('report.create_report') }}"
                        class="text-blue-600 hover:underline">Ikuti Tautan</a>.
                </li>
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
                    provinceDropdown.append(`<option value="${province.id}">${province.name}</option>`);
                });
            }).fail(function () {
                alert("Gagal memuat data provinsi. Silakan coba lagi.");
                $("#province").empty().append('<option value="" disabled selected>Gagal memuat data</option>');
            });
        });
    </script>
    @endsection