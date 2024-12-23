@extends('templates.app')

@section('content')
    <form action="{{ route('report.index') }}" method="GET" class="space-y-4">
        <div>
            <label for="province" class="block text-sm font-medium text-gray-700">Pilih Provinsi</label>
            <select id="province" name="province"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <option value="" disabled selected>Memuat data...</option>
            </select>
        </div>
        <button type="submit"
            class="w-full bg-green-500 text-white px-4 py-2 rounded-md shadow-md hover:bg-gray-600 focus:ring focus:ring-blue-300 focus:ring-offset-2">
            Cari
        </button>
    </form>

    @forelse($reports as $report)
        <div class="flex items-start bg-white shadow-md rounded-lg p-3 border border-gray-200 hover:shadow-lg transition mb-3">
            <img src="{{ asset('assets/images/' . ($report->image ?? 'default.jpg')) }}" alt="{{ $report->name ?? 'No Name' }}"
                class="w-16 h-16 rounded-md object-cover flex-shrink-0">
            <div class="ml-3 flex-grow">
                <h5 class="text-sm font-bold text-gray-800 truncate">{{ $report->description ?? 'Deskripsi tidak tersedia' }}</h5>
                <p class="text-xs text-gray-600">{{ $report['user']['email'] ?? 'Nama tidak tersedia' }}</p>
                <p id="province-{{ $report->id }}" class="text-xs text-gray-600">Lokasi: Memuat...</p>
                <div class="flex justify-between items-center mt-2">
                    <div class="flex text-xs text-gray-600 space-x-2">
                        <span class="flex items-center">
                            <i class="fa fa-eye mr-1"></i>{{ $report->viewers ?? '0' }}
                        </span>
                        <span class="flex items-center">
                            <i class="fa fa-heart mr-1 cursor-pointer" id="love-{{ $report->id }}"
                                style="{{ $report->voting > 0 ? 'color: red;' : '' }}"
                                data-report-id="{{ $report->id }}" onclick="toggleLove({{ $report->id }})"></i>
                            <span id="voting-count-{{ $report->id }}">{{ $report->voting ?? '0' }}</span>
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <span
                            class="bg-green-500 text-white text-xs font-medium px-2 py-0.5 rounded">{{ $report->type ?? 'Tidak diketahui' }}</span>
                        <span
                            class="bg-gray-200 text-gray-800 text-xs font-medium px-2 py-0.5 rounded">{{ $report->created_at ?? 'Tidak diketahui' }}</span>
                    </div>
                </div>
                <a href="{{ route('report.show', ['id' => $report->id]) }}"
                    class="block mt-2 text-blue-500 text-xs hover:underline font-medium">Detail</a>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                Tidak ada laporan yang tersedia.
            </div>
        </div>
    @endforelse

    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://unpkg.com/flowbite@1.4.8/dist/flowbite.min.css" rel="stylesheet">
        <style>
            .btn-success {
                background-color: #28a745;
                border-color: #28a745;
            }

            .btn-success:hover {
                background-color: #218838;
                border-color: #1e7e34;
            }

            .bg-gray-100 {
                background-color: #f7fafc;
            }

            .text-gray-600 {
                color: #718096;
            }

            .text-gray-800 {
                color: #2d3748;
            }
        </style>
    @endpush

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const apiEndpoint = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";
            $.getJSON(apiEndpoint)
                .done(function(data) {
                    const provinceDropdown = $("#province");
                    provinceDropdown.empty();
                    provinceDropdown.append('<option value="" disabled selected>Pilih Provinsi</option>');
                    $.each(data, function(index, province) {
                        provinceDropdown.append(
                            `<option value="${province.id}">${province.name}</option>`);
                    });
                })
                .fail(function() {
                    alert("Gagal memuat data provinsi. Silakan coba lagi.");
                    $("#province").empty().append(
                        '<option value="" disabled selected>Gagal memuat data</option>');
                });
        });

        function toggleLove(reportId) {
            const loveIcon = document.getElementById(`love-${reportId}`);
            const votingCount = document.getElementById(`voting-count-${reportId}`);

            const isLoved = loveIcon.style.color === 'red';

            loveIcon.style.color = isLoved ? '' : 'red';
            let currentVote = parseInt(votingCount.textContent, 10) || 0;
            votingCount.textContent = isLoved ? currentVote - 1 : currentVote + 1;

            fetch(`/vote/${reportId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        vote: isLoved ? -1 : 1
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        votingCount.textContent = data.newVotingCount;
                    } else {
                        throw new Error('Gagal memperbarui vote');
                    }
                })
                .catch(error => {
                    loveIcon.style.color = isLoved ? 'red' : '';
                    votingCount.textContent = currentVote;
                    alert("Terjadi kesalahan. Silakan coba lagi.");
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.8/dist/flowbite.min.js"></script>
@endsection
