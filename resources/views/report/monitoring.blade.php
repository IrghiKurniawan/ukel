@extends('templates.app')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Monitoring</h1>

    @if ($reports->isEmpty())
        <p class="text-gray-600">Belum pernah melaporkan apapun.</p>
    @else
        @foreach ($reports as $key => $report)
        <div class="max-w-4xl mx-auto my-6">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="bg-gray-500 text-white text-center py-3">
                    <h4 class="text-lg font-semibold">Report Details</h4>
                </div>
                <div class="p-6">
                    <h5 class="text-lg font-semibold mb-4">Pengaduan: {{ $report->created_at }}</h5>
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2 cursor-pointer" onclick="toggleView('data', {{ $key }})">Data</th>
                                <th class="border border-gray-300 px-4 py-2 cursor-pointer" onclick="toggleView('image', {{ $key }})">Image</th>
                                <th class="border border-gray-300 px-4 py-2 cursor-pointer" onclick="toggleView('status', {{ $key }})">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="data-row-{{ $key }}" class="content-row">
                                <td colspan="3" class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-col gap-2">
                                        <strong>Deskripsi:</strong> {{ $report->description }} <br>
                                        <strong>Email:</strong> {{ $report->user->email }} <br>
                                        <strong>Alamat:</strong> {{ $report->province }} <br>
                                        <strong>Type:</strong> {{ $report->type }}
                                    </div>
                                </td>
                            </tr>
                            <tr id="image-row-{{ $key }}" class="content-row hidden">
                                <td colspan="3" class="border border-gray-300 px-4 py-2">
                                    <div class="flex flex-col items-center">
                                        <strong>Image:</strong>
                                        <img src="{{ asset('assets/images/' . ($report->image ?? 'default.jpg')) }}" 
                                             class="w-full h-auto max-w-md object-cover rounded-md" 
                                             alt="Image of {{ $report->name ?? 'No Name' }}">
                                    </div>
                                </td>
                            </tr>
                            <tr id="status-row-{{ $key }}" class="content-row hidden">
                                <td colspan="3" class="border border-gray-300 px-4 py-2">
                                    @if ($report->response && $report->response->response_status)
                                        <div class="flex flex-col gap-2">
                                            <strong>Status:</strong>
                                            {{ $report->response->response_status }}
                                        </div>
                                        @if ($progresses->isEmpty())
                                            <p class="text-gray-500">Belum ada progress yang tercatat.</p>
                                        @else
                                            @foreach ($progresses as $progress)
                                                <div class="bg-gray-100 p-3 rounded-lg mb-2">
                                                    <h6 class="text-sm font-semibold">History Progress:</h6>
                                                    @if (is_array($progress->histories) && count($progress->histories) > 0)
                                                        <ul class="list-disc pl-5">
                                                            @foreach ($progress->histories as $history)
                                                                <li>
                                                                    <strong>{{ \Carbon\Carbon::parse($history['created_at'])->format('d M Y H:i') }}:</strong>
                                                                    {{ $history['response_progress'] }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <p class="text-gray-500">Tidak ada progress untuk response ini.</p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    @else
                                        <div class="flex items-center justify-between">
                                            <strong>Status:</strong>
                                            Belum ada respon
                                            <button class="text-red-500 underline" data-modal-target="deleteModal" onclick="setReportId({{ $report->id }})">Hapus</button>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Modal Hapus Pengaduan -->
        <div id="deleteModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h1 class="text-lg font-bold mb-4">Hapus Pengaduan</h1>
                <p class="mb-4">Apakah Anda yakin ingin menghapus pengaduan ini?</p>
                <div class="flex justify-end gap-4">
                    <button class="px-4 py-2 bg-gray-500 text-white rounded-lg" data-modal-hide="deleteModal">Close</button>
                    <form action="{{ route('report.destroy', $report->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <script>
        function toggleView(view, reportIndex) {
            const rows = document.querySelectorAll(`#data-row-${reportIndex}, #image-row-${reportIndex}, #status-row-${reportIndex}`);
            rows.forEach(row => row.classList.add('hidden'));
            document.getElementById(`${view}-row-${reportIndex}`).classList.remove('hidden');
        }
    </script>
@endsection
