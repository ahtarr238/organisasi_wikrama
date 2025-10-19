@extends('templates.app')

@php
use Illuminate\Support\Str;
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

        .jadwal-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .jadwal-hero::before {
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

        .jadwal-section {
            background: linear-gradient(180deg, var(--light-color) 0%, #ffffff 80%);
            padding-bottom: 60px;
            padding-top: 20px;
            position: relative;
            overflow: hidden;
        }

        .jadwal-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/></svg>');
            background-size: 100px 100px;
            z-index: -1;
        }

        .jadwal-badge {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 12px;
            color: #fff;
        }

        .badge-on_going {
            background-color: var(--accent-color);
        }

        .badge-completed {
            background-color: #28a745;
        }

        .badge-cancelled {
            background-color: #dc3545;
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

        .card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(31, 45, 61, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(31, 45, 61, 0.15);
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
<div class="container-fluid jadwal-hero">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="fw-bold text-white mb-4 section-title">
                    Detail Jadwal Kegiatan
                    <span class="text-warning">.</span>
                </h1>
                <p class="lead text-white-50 mb-4">
                    Informasi lengkap mengenai kegiatan organisasi OSIS-MPR Wikrama.
                </p>
            </div>
        </div>
        <div class="row mt-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            <div class="col-12">
                <div class="d-flex flex-wrap align-items-center">
                    <a href="{{ route('schedule') }}" class="btn btn-outline-light rounded-pill mb-3">
                        <i class="fas fa-arrow-left me-1"></i> Kembali ke Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Schedule Detail Section -->
<div class="container-fluid jadwal-section">
    <div class="container">
        <div class="card shadow-sm" data-aos="fade-up" data-aos-duration="1000">
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-8">
                        <h2 class="fw-bold mb-3">{{ $event->title }}</h2>
                    </div>
                    <div class="col-md-4 text-md-end">
                        @if($event->status == 'on_going')
                            <span class="jadwal-badge badge-on_going">Berlangsung</span>
                        @elseif($event->status == 'completed')
                            <span class="jadwal-badge badge-completed">Selesai</span>
                        @elseif($event->status == 'cancelled')
                            <span class="jadwal-badge badge-cancelled">Dibatalkan</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="far fa-calendar text-primary me-2"></i>
                            <div>
                                <div class="text-muted small">Tanggal</div>
                                <div class="fw-semibold">{{ $event->date->format('d F Y') }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="far fa-clock text-primary me-2"></i>
                            <div>
                                <div class="text-muted small">Waktu</div>
                                <div class="fw-semibold">{{ $event->start_time }} - {{ $event->end_time }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <h5 class="fw-semibold mb-2">Deskripsi Kegiatan</h5>
                    <p class="text-muted">{{ $event->description }}</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-user text-primary me-2"></i>
                            <div>
                                <div class="text-muted small">Penanggung Jawab</div>
                                <div class="fw-semibold">{{ $event->user->name ?? 'Unknown' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">
                            <i class="far fa-calendar-plus me-1"></i> Dibuat pada {{ $event->created_at->format('d M Y H:i') }}
                        </small>
                        @if($event->updated_at->diffInHours($event->created_at) > 0)
                            <small class="text-muted">
                                <i class="far fa-edit me-1"></i> Diupdate pada {{ $event->updated_at->format('d M Y H:i') }}
                            </small>
                        @endif
                    </div>
                </div>
            </div>
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
</script>
@endsection
