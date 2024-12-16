@extends('templates.app')

@section('content')
    <div class="container">
        <h1 class="mb-4 text-primary">Daftar Laporan</h1>

        @if ($reports->isEmpty())
            <p class="text-muted">Tidak ada laporan ditemukan.</p>
        @else
            @foreach ($reports as $report)
                <div class="card shadow mb-4 border-0 rounded-3 hover-card">
                    <div class="card-body p-4">
                        <h3 class="card-title text-primary mb-4 border-bottom pb-3 d-flex align-items-center">
                            <i class="fas fa-file-alt me-3"></i> Deskripsi Kejadian
                        </h3>
                        <div class="row">
                            @if ($report->image)
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <img src="{{ asset('storage/' . $report->image) }}" class="img-fluid rounded shadow hover-zoom"
                                         alt="Gambar Laporan">
                                </div>
                            @endif
                            <div class="col-md-{{ $report->image ? '8' : '12' }}">
                                <div class="description-content p-3 rounded-3">
                                    <div class="mb-3">
                                        <strong class="text-primary">Tipe Kejadian:</strong>
                                        <span class="ms-2">{{ $report->type }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="text-primary">Provinsi Kejadian: </strong>
                                        <span class="ms-2">{{ $report->province }}</span>
                                    </div>
                                    <div class="mb-3">
                                        <strong class="text-primary">Tanggal Kejadian:</strong>
                                        <span class="ms-2">{{ $report->created_at->format('d F Y') }}</span>
                                    </div>
                                    <div>
                                        <strong class="text-primary">Deskripsi:</strong>
                                        <p class="mb-0">{{ $report->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Komentar -->
                        <div>
                            <h4 class="text-primary mb-3 pb-3 border-bottom">Komentar</h4>
                            @if ($report->comments->isEmpty())
                                <p class="text-muted">Belum ada komentar pada laporan ini.</p>
                            @else
                                @foreach ($report->comments as $comment)
                                    <div class="comment-item mb-3">
                                        <strong>{{ $comment->user->email }}</strong> - {{ $comment->created_at->diffForHumans() }}
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        
                        <!-- Form Tambah Komentar -->
                        <div class="mt-4">
                            <h4 class="text-primary mb-3 d-flex align-items-center" style="cursor: pointer" onclick="toggleCommentForm()">
                                <i class="fas fa-plus-circle me-3"></i> Tambah Komentar
                            </h4>
                            <form method="POST" action="{{ route('storeComment', $report->id) }}" id="commentForm" style="display: none;">
                                @csrf
                                <div class="mb-3">
                                    <textarea name="comment" class="form-control border-0 bg-light shadow-sm rounded-3" rows="4"
                                              placeholder="Tulis komentar Anda..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill hover-button">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Komentar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="bg-white border rounded-lg shadow-md p-6">
        <h5 class="text-xl font-bold mb-4">Informasi Pembuatan Pengaduan</h5>
        <ul class="list-disc pl-5 text-gray-700 space-y-2">
            <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
            <li>Keseluruhan data pada pengaduan bernilai BENAR dan DAPAT DIPERTANGGUNG JAWABKAN.</li>
            <li>Seluruh bagian data perlu diisi.</li>
            <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>
            <li>Periksa tanggapan Kami, pada Dashboard setelah Anda Login.</li>
            <li>Pembuatan pengaduan dapat dilakukan pada halaman berikut: <a href="{{ route('report.create_report') }}"
                    class="text-blue-600 hover:underline">Ikuti Tautan</a>.</li>
        </ul>
    </div>
</div>

    <script>
        function toggleCommentForm() {
            const form = document.getElementById('commentForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endsection
