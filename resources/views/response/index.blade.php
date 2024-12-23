@extends('templates.app')

@section('content')
    <div class="container mx-auto mt-5">
        <div class="grid grid-cols-1 gap-4">
            <div class="mb-4">
                <!-- Form untuk pencarian -->
                <form method="GET" action="{{ route('response') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="col-span-10">
                        <label for="province-search" class="block text-sm font-medium text-gray-700">Pilih Provinsi:</label>
                        <select name="province" id="province-search"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Semua Provinsi</option>
                        </select>
                    </div>
                    <div class="col-span-2 flex items-end">
                        <button type="submit"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Cari</button>
                    </div>
                </form>

                <!-- Form untuk ekspor -->
                <form method="GET" action="{{ route('report.export') }}"
                    class="grid grid-cols-1 md:grid-cols-12 gap-4 mt-4">
                    <div class="col-span-4">
                        <label for="province-export" class="block text-sm font-medium text-gray-700">Pilih Provinsi untuk
                            Export:</label>
                        <select name="province" id="province-export"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="">Semua Provinsi</option>
                            <!-- Option lainnya akan dimuat di sini -->
                        </select>
                    </div>
                    <div class="col-span-12 mt-3">
                        <button type="submit"
                            class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            id="export-button" disabled>Export</button>
                    </div>
                </form>
            </div>
            <div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Gambar & Pengirim</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Provinsi</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Voting</th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($responses as $index => $report)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <img src="{{ asset('assets/images/' . ($report->image ?? 'default.jpg')) }}"
                                                alt="Image of {{ $report->name ?? 'No Name' }}"
                                                class="w-16 h-16 rounded-full object-cover mr-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $report['user']['email'] ?? 'Nama tidak tersedia' }}</div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" id="province-{{ $report->id }}">Memuat...</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{ $report->description ?? 'Deskripsi tidak tersedia' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="text-sm text-gray-500"><i
                                                class="bi bi-eye mr-1"></i>{{ $report->voting ?? '0' }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('response.show', ['id' => $report->id]) }}"
                                            class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">Tidak ada
                                        laporan yang tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @endpush

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const provinceSelectSearch = document.getElementById('province-search');
                const provinceSelectExport = document.getElementById('province-export');
                const exportButton = document.getElementById('export-button');
                const reports = @json($responses);
                let availableProvinces = []; // Menyimpan provinsi yang ada di dalam tabel

                // Ambil data provinsi yang ada dalam tabel
                reports.forEach(report => {
                    const provinceId = report.province;
                    if (!availableProvinces.includes(provinceId)) {
                        availableProvinces.push(provinceId);
                    }   
                });

                // Mengambil data provinsi dari API untuk dropdown pencarian
                fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
                    .then(response => response.json())
                    .then(data => {
                        // Untuk pencarian (province-search)
                        data.forEach(province => {
                            const option = document.createElement('option');
                            option.value = province.id;
                            option.textContent = province.name;
                            provinceSelectSearch.appendChild(option);
                        });

                        // Untuk ekspor (province-export) hanya provinsi yang ada dalam tabel
                        data.forEach(province => {
                            if (availableProvinces.includes(province.id)) {
                                const option = document.createElement('option');
                                option.value = province.id;
                                option.textContent = province.name;
                                provinceSelectExport.appendChild(option);
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error fetching provinces:', error);
                    });

                // Menambahkan event listener untuk dropdown ekspor untuk mengaktifkan/menonaktifkan tombol export
                provinceSelectExport.addEventListener('change', function() {
                    const selectedProvince = provinceSelectExport.value;

                    if (selectedProvince === "" || availableProvinces.includes(selectedProvince)) {
                        exportButton.disabled = false; // Aktifkan tombol Export jika provinsi valid dipilih
                    } else {
                        exportButton.disabled =
                        true; // Nonaktifkan tombol Export jika tidak ada provinsi yang valid dipilih
                    }
                });
            });
        </script>
    @endpush
@endsection
