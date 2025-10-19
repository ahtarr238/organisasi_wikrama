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

        .table thead th {
            background-color: var(--primary-color);
            color: #fff;
            border-bottom: none;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(31, 57, 132, 0.05);
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

        .jadwal-empty {
            color: #6c757d;
            text-align: center;
            padding: 80px 0;
        }

        .jadwal-empty i {
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

        .card {
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(31, 45, 61, 0.1);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(31, 45, 61, 0.15);
        }

        .modal-header {
            background-color: var(--primary-color);
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

        /* Fix for modal z-index and backdrop */
        .modal {
            z-index: 1055;
        }

        .modal-backdrop {
            z-index: 1050;
        }

        .modal-content {
            z-index: 1060;
        }
    </style>

<!-- Hero Section -->
<div class="container-fluid jadwal-hero">
    <div class="container position-relative" style="z-index: 2;">
        <div class="row align-items-center">
            <div class="col-md-8" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="fw-bold text-white mb-4 section-title">
                    Jadwal Kegiatan
                    <span class="text-warning">.</span>
                </h1>
                <p class="lead text-white-50 mb-4">
                    Informasi lengkap mengenai jadwal kegiatan organisasi OSIS-MPR Wikrama.
                </p>
                <p class="lead text-white-50">
                    Tetap update dengan semua kegiatan dan acara yang akan datang. Jadwal yang terstruktur untuk memastikan semua program berjalan dengan lancar.
                </p>
            </div>
        </div>
        <div class="row mt-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
            <div class="col-12">
                <div class="d-flex flex-wrap align-items-center">
                    @if(Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'staff'))
                    <a href="{{ route('schedule.export') }}" class="btn btn-light rounded-pill me-3 mb-3">
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

<!-- Schedule Section -->
<div class="container-fluid jadwal-section">
    <div class="container">
        <div class="card shadow-sm" data-aos="fade-up" data-aos-duration="1000">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Judul Kegiatan</th>
                                <th>Waktu</th>
                                <th>Status</th>
                                <th>Penanggung Jawab</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $index => $event)
                            <tr data-aos="fade-up" data-aos-duration="800" data-aos-delay="{{ $loop->iteration * 100 }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $event->date->format('d M Y') }}</td>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->start_time }} - {{ $event->end_time }}</td>
                                <td>
                                    @if($event->status == 'on_going')
                                        <span class="jadwal-badge badge-on_going">Berlangsung</span>
                                    @elseif($event->status == 'completed')
                                        <span class="jadwal-badge badge-completed">Selesai</span>
                                    @elseif($event->status == 'cancelled')
                                        <span class="jadwal-badge badge-cancelled">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>{{ $event->user->name ?? 'Unknown' }}</td>
                                <td>
                                    <a href="{{ route('schedule.detail', $event->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>


                            @endforeach

                            @if($events->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    <div class="jadwal-empty" data-aos="fade-up" data-aos-duration="1000">
                                        <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                                        <p>Belum ada jadwal kegiatan yang tersedia.</p>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
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
