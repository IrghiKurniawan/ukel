@extends('templates.app')
@section('content')
<div class="container py-5 d-flex justify-content-center gap-4">
    <div class="row g-4 w-100">
        <div class="col-12">
            <div class="card border-0 shadow-lg overflow-hidden">
                <div class="col-md-6">
                    <h1 class="mb-2"><strong>Penulis:</strong> {{ old('user', $report->user->email) ?? 'Penulis tidak tersedia' }} 👤</h1>
                    <p class="mb-2"><strong>Tanggal:</strong> {{ old('date', $report->created_at->format('Y-m-d')) ?? 'Tanggal tidak tersedia' }} 📅</p>
                </div>
                <img src="{{ asset('assets/images/' . (old('image', $report->image) ?? 'default.jpg')) }}" 
                     class="card-img-top img-fluid" 
                     alt="Image of {{ old('name', $report->name) ?? 'No Name' }}" 
                     style="height: 400px; object-fit: cover;">
                <div class="card-body p-4">
                    <h2 class="card-title mb-3 fw-bold">{{ old('name', $report->description) ?? 'Nama tidak tersedia' }} </h2>
                </div>
                <div class="d-flex mb-3 gap-2">
                    @if(is_null($report->response?->response_status))
                        <!-- Jika response_status null -->
                        <form action="{{ route('response.status', $report->id) }}" method="POST" class="flowbite-form">
                            @csrf
                            <input type="hidden" name="response_status" value="ON_PROGRESS">
                            <button class="flowbite-btn flowbite-btn-primary" type="submit">Berikan Progres</button>
                        </form>
                        <form action="{{ route('response.status', $report->id) }}" method="POST" class="flowbite-form">
                            @csrf
                            <input type="hidden" name="response_status" value="REJECTED">
                            <button class="flowbite-btn flowbite-btn-danger" type="submit">Reject</button>
                        </form>
                    @elseif($report->response?->response_status === 'ON_PROGRESS')
                        <!-- Jika response_status ada -->
                        <form action="{{ route('response.status', $report->id) }}" method="POST" class="flowbite-form">
                            @csrf
                            <input type="hidden" name="response_status" value="ON_PROGRESS">
                            <button class="flowbite-btn flowbite-btn-primary" type="submit">Berikan Progres</button>
                        </form>
                        <form action="{{ route('response.update.status', $report->id) }}" method="POST" class="flowbite-form">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="response_status" value="DONE">
                            <button class="flowbite-btn flowbite-btn-success" type="submit">Nyatakan Selesai</button>
                        </form>
                        <form action="{{ route('response.progress', $report->id) }}" method="POST" class="flowbite-form">
                            @csrf
                            <div class="container mt-4">
                                <div class="card p-4 shadow-sm">
                                    <h4 class="card-title mb-4">Kirim Response Progress</h4>
                                    <div class="mb-3">
                                        <label for="response_progress" class="form-label">Response Progress</label>
                                        <textarea name="response_progress" id="response_progress" class="form-control" rows="6" placeholder="Tulis response progress..."></textarea>
                                    </div>
                                    <button type="submit" class="flowbite-btn flowbite-btn-primary w-100">Kirim Response Progress</button>
                                </div>
                            </div>
                        </form>
                    @else
                        <h1>Status: {{ $report->response?->response_status }}</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('vendor/flowbite/dist/flowbite.bundle.min.js') }}"></script>
@endpush
