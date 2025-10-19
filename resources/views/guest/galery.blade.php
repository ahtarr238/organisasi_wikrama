@extends('templates.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<style>
    .galeri-hero {
        background: linear-gradient(360deg, #ffffff 0%, #f0f8ff 60%);
        padding: 60px 0 30px 0;
    }

    .galeri-card {
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.35s ease;
        background-color: #ffffff;
        box-shadow: 0 6px 20px rgba(31, 45, 61, 0.08);
    }

    .galeri-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 30px rgba(31, 45, 61, 0.15);
    }

    .galeri-card img {
        height: 300px;
        object-fit: cover;
        width: 100%;
        transition: transform 0.4s ease;
    }

    .galeri-card:hover img {
        transform: scale(1.05);
    }

    .galeri-card .card-body {
        padding: 20px;
    }

    .galeri-badge {
        background-color: #1F3984;
        font-size: 0.75rem;
        padding: 6px 12px;
        border-radius: 20px;
        color: #fff;
        letter-spacing: 0.5px;
    }

    .galeri-empty {
        color: #6c757d;
        text-align: center;
        padding: 80px 0;
    }

    .galeri-empty i {
        color: #1F3984;
    }

    .btn-outline-primary {
        border-color: #1F3984;
        color: #1F3984;
    }

    .btn-outline-primary:hover {
        background-color: #1F3984;
        color: #fff;
    }

    .galeri-section {
        background: linear-gradient(180deg, #f0f8ff 0%, #ffffff 80%);
        padding-bottom: 60px;
        padding-top: 20px;
    }
</style>

<!-- Hero Section -->
<div class="container-fluid galeri-hero">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="fw-bold mb-2" style="color: #1F3984;">Galeri Kegiatan</h2>
                <p class="text-muted mb-0">Kumpulan momen berharga dalam setiap perjalanan organisasi OSIS-MPR Wikrama.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('galery.export') }}" class="btn btn-success rounded-pill shadow-sm me-2">
                    <i class="fas fa-download me-1"></i> Export CSV
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                    <i class="fas fa-home me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Galeri Section -->
<div class="container-fluid galeri-section">
    <div class="container">
        <div class="row g-4 mt-2">
            @foreach ($galleries as $gallery)
            <div class="col-md-4">
                <div class="card galeri-card h-100">
                    @if($gallery->photo_url)
                        <img src="{{ Storage::url('galery/' . $gallery->photo_url) }}" alt="{{ $gallery->title }}">
                    @else
                        <img src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" alt="Placeholder">
                    @endif

                    <div class="card-body d-flex flex-column">
                        <h5 class="fw-semibold text-dark">{{ $gallery->title }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($gallery->description, 100) }}</p>

                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="galeri-badge">{{ strtoupper($gallery->category) }}</span>
                                <small class="text-muted">{{ $gallery->uploaded_at->format('d M Y H:i') }}</small>
                            </div>
                            <div class="text-muted small mb-3">
                                <i class="fas fa-user me-1 text-secondary"></i> {{ $gallery->uploader->name ?? 'Unknown' }}
                            </div>
                            <button class="btn btn-sm btn-outline-primary w-100 rounded-pill"
                                    data-mdb-toggle="modal"
                                    data-mdb-target="#galleryModal{{ $gallery->id }}">
                                <i class="fas fa-eye me-1"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="galleryModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="galleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header" style="background-color: #1F3984;">
                            <h5 class="modal-title text-white fw-bold" id="galleryModalLabel{{ $gallery->id }}">
                                {{ $gallery->title }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-3">
                                @if($gallery->photo_url)
                                    <img src="{{ Storage::url('galery/' . $gallery->photo_url) }}" 
                                         class="img-fluid rounded shadow-sm" 
                                         alt="{{ $gallery->title }}" 
                                         style="max-height:450px;">
                                @else
                                        <div class="col-12 text-center text-muted py-5">
                                            <i class="fas fa-images fa-3x mb-3"></i>
                                            <p>Belum ada galeri yang tersedia.</p>
                                        </div>
                                @endif
                            </div>
                            <p class="text-muted">{{ $gallery->description }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="galeri-badge">{{ strtoupper($gallery->category) }}</span>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i> {{ $gallery->uploader->name ?? 'Unknown' }} |
                                    <i class="far fa-clock me-1"></i> {{ $gallery->uploaded_at->format('d M Y H:i') }}
                                </small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary rounded-pill" data-mdb-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @if($galleries->isEmpty())
            <div class="col-12 galeri-empty">
                <i class="fas fa-images fa-3x mb-3"></i>
                <p class="fs-5">Belum ada galeri yang tersedia.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- MDBootstrap JS (jika belum dimasukkan di layout utama) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
@endsection
