@extends('templates.app')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1F3984;
            --secondary-color: #4A6FE3;
            --accent-color: #FFC107;
            --light-color: #f0f8ff;
            --dark-color: #1a1a2e;
        }

        .galeri-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .galeri-hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="40" fill="none" stroke="%23ffffff" stroke-width="0.5" opacity="0.2"/></svg>');
            background-size: 100px 100px;
            z-index: 1;
        }

        .galeri-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            background-color: #ffffff;
            box-shadow: 0 10px 30px rgba(31, 45, 61, 0.1);
            height: 100%;
        }

        .galeri-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(31, 45, 61, 0.15);
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
            background-color: var(--primary-color);
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
            color: var(--primary-color);
            font-size: 4rem;
        }

        .btn-outline-primary {
            border-color: var(--primary-color);
            color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(31, 57, 132, 0.3);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(31, 57, 132, 0.3);
        }

        .galeri-section {
            background: linear-gradient(180deg, var(--light-color) 0%, #ffffff 80%);
            padding-bottom: 60px;
            padding-top: 20px;
            position: relative;
            overflow: hidden;
        }

        .galeri-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><circle cx="25" cy="25" r="10" fill="none" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/><circle cx="75" cy="75" r="10" fill="none" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/></svg>');
            background-size: 100px 100px;
            z-index: -1;
        }

        .section-title {
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }

        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
    </style>

<!-- Hero Section -->
<div class="container-fluid galeri-hero">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="fw-bold text-white mb-4 section-title">
                    Galeri Kegiatan
                    <span class="text-warning">.</span>
                </h1>
                <p class="lead text-white-50 mb-4">
                    Kumpulan momen berharga dalam setiap perjalanan organisasi OSIS-MPR Wikrama.
                </p>
                <p class="lead text-white-50">
                    Dokumentasi kegiatan yang menunjukkan semangat, dedikasi, dan kebersamaan dalam setiap program yang dilaksanakan.
                </p>
            </div>
        </div>
        <div class="row mt-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            <div class="col-12">
                <div class="d-flex flex-wrap align-items-center">
                    @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'staff'))
                    <a href="{{ route('galery.export') }}" class="btn btn-light rounded-pill me-3 mb-3">
                        <i class="fas fa-download me-1"></i> Export CSV
                    </a>
                    @endif
                    <a href="{{ route('home') }}" class="btn btn-outline-light rounded-pill mb-3">
                        <i class="fas fa-home me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Galeri Section -->
<div class="container-fluid galeri-section">
    <div class="container">
        <div class="row g-4 mt-2">
            @foreach ($galleries as $gallery)
            <div class="col-md-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="card galeri-card h-100">
                    <div class="position-relative overflow-hidden" style="height: 300px;">
                        @if($gallery->photo_url)
                            <img src="{{ Storage::url('galery/' . $gallery->photo_url) }}" alt="{{ $gallery->title }}" class="img-fluid w-100" style="object-fit:cover; height:100%;">
                        @else
                            <img src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" alt="Placeholder" class="img-fluid w-100" style="object-fit:cover; height:100%;">
                        @endif
                        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-end"
                             style="background: linear-gradient(to top, rgba(31,57,132,0.8) 0%, transparent 100%);">
                            <div class="p-3 text-white w-100">
                                <h5 class="fw-bold mb-0">{{ $gallery->title }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-muted mb-3">{{ Str::limit($gallery->description, 100) }}</p>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="galeri-badge">{{ strtoupper($gallery->category) }}</span>
                            <small class="text-muted">{{ $gallery->uploaded_at->format('d M Y H:i') }}</small>
                        </div>
                        <div class="text-muted small mb-3">
                            <i class="fas fa-user me-1 text-secondary"></i> {{ $gallery->uploader->name ?? 'Unknown' }}
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary w-100 rounded-pill" onclick="openGalleryModal{{ $gallery->id }}()">
                            <i class="fas fa-eye me-1"></i> Lihat Detail
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade" id="galleryModal{{ $gallery->id }}" tabindex="-1" aria-labelledby="galleryModalLabel{{ $gallery->id }}" aria-hidden="true" data-mdb-backdrop="static" data-mdb-keyboard="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg">
                        <div class="modal-header" style="background-color: var(--primary-color);">
                            <h5 class="modal-title text-white fw-bold" id="galleryModalLabel{{ $gallery->id }}">
                                {{ $gallery->title }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
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
            <div class="col-12 galeri-empty" data-aos="fade-up" data-aos-duration="1000">
                <i class="fas fa-images fa-3x mb-3"></i>
                <p class="fs-5">Belum ada galeri yang tersedia.</p>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });

    // Functions to open gallery modals
    @foreach ($galleries as $gallery)
    function openGalleryModal{{ $gallery->id }}() {
        const myModal = new mdb.Modal(document.getElementById('galleryModal{{ $gallery->id }}'));
        myModal.show();
    }
    @endforeach
</script>
@endsection
