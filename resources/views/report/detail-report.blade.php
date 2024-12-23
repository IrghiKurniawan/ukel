@extends('templates.app')

{{-- @push('styles')
<style>
    .card-img-top {
        transition: transform 0.3s ease-in-out;
    }
    .card-img-top:hover {
        transform: scale(1.05);
    }

    .comment-card {
        opacity: 0;
        animation: fadeInUp 0.6s forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .comment-form {
        transition: all 0.3s ease;
    }
    .comment-form:hover {
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
</style>
@endpush --}}

@section('content')
    <div class="container mx-auto py-5">
        <div class="grid grid-cols-1 gap-4">
            <div class="col-span-1">
                <div class="bg-white border shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ asset('assets/images/' . (old('image', $report->image) ?? 'default.jpg')) }}"
                        class="w-full object-cover" alt="Image of {{ old('name', $report->name) ?? 'No Name' }}"
                        style="height: 400px;">
                    <div class="p-4">
                        <h2 class="text-xl font-bold mb-3">{{ old('name', $report->description) ?? 'Nama tidak tersedia' }}
                            🔍</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="mb-2"><strong>Penulis:</strong>
                                    {{ old('user', $report->user->email) ?? 'Penulis tidak tersedia' }} 👤</p>
                                <p class="mb-2"><strong>Tanggal:</strong>
                                    {{ old('date', $report->created_at->format('Y-m-d')) ?? 'Tanggal tidak tersedia' }} 📅
                                </p>
                            </div>
                            <div>
                                <p class="mb-2"><strong>Type:</strong>
                                    {{ old('type', $report->type) ?? 'Tidak diketahui' }} 🏷️</p>
                                <p class="mb-2">
                                    <strong>Status:</strong>
                                    <span
                                        class="px-3 py-1 rounded-full {{ $report->response?->response_status == 'DONE' ? 'bg-green-500 text-white' : ($report->response?->response_status == 'REJECTED' ? 'bg-red-500 text-white' : ($report->response?->response_status == 'ON_PROGRESS' ? 'bg-blue-500 text-white' : 'bg-yellow-500 text-black')) }}">
                                        {{ ucfirst($report->response?->response_status) }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <h2 class="text-center text-xl font-semibold mb-4">Komentar 💬</h2>

            <div class="grid grid-cols-1 gap-4">
                <div class="col-span-1">
                    @forelse ($comments as $index => $comment)
                        <div class="bg-white border rounded-lg shadow-sm p-4 mb-3 comment-card"
                            style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="flex items-center mb-2">
                                <h5 class="font-bold mr-2">{{ $comment['user']['email'] }}</h5>
                                <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <div class="text-center text-gray-500">
                            Belum ada komentar 🤷‍♀️
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Form Tambah Komentar -->
            <!-- Form Tambah Komentar -->
            <div class="mt-5">
                <div class="max-w-md mx-auto">
                    <div class="bg-white border border-gray-200 shadow-md rounded-lg p-6 comment-form">
                        <h4 class="text-center text-xl font-medium text-gray-800 mb-4">Tambah Komentar 💡</h4>
                        <form action="{{ route('report.comment', $report->id) }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <textarea
                                    class="w-full border border-gray-300 rounded-lg p-3 text-sm text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none @error('comment') border-red-500 @enderror"
                                    id="comment" name="comment" style="height: 150px;" placeholder="Tulis komentar Anda di sini..." required></textarea>
                                @error('comment')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit"
                                class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition duration-150 ease-in-out">
                                Kirim Komentar 🚀
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Optional: Add any additional interactivity if needed
        document.addEventListener('DOMContentLoaded', function() {
            const commentCards = document.querySelectorAll('.comment-card');
            commentCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });

        fetch('http://127.0.0.1:8000/vote/1', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Jika menggunakan CSRF
                },
                body: JSON.stringify({
                    vote: 'like'
                }) // atau vote: 'dislike' berdasarkan kebutuhan
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message); // Menampilkan pesan dari server
                }
            })
            .catch(error => console.error('Error:', error));
    </script>
@endpush
