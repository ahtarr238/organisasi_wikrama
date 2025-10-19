@extends('templates.app')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<style>
    .jadwal-hero {
        background: linear-gradient(360deg, #ffffff 0%, #f0f8ff 60%);
        padding: 60px 0 30px 0;
    }

    .jadwal-section {
        background: linear-gradient(180deg, #f0f8ff 0%, #ffffff 80%);
        padding-bottom: 60px;
        padding-top: 20px;
    }

    .table thead th {
        background-color: #1F3984;
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
        background-color: #ffc107;
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

    .modal-header {
        background-color: #1F3984;
    }
</style>

<!-- Hero Section -->
<div class="container-fluid jadwal-hero">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div>
                <h2 class="fw-bold mb-2" style="color: #1F3984;">Jadwal Kegiatan</h2>
                <p class="text-muted mb-0">Informasi lengkap mengenai jadwal kegiatan organisasi OSIS-MPR Wikrama.</p>
            </div>
            <div class="mt-3 mt-md-0">
                <a href="{{ route('schedule.export') }}" class="btn btn-success rounded-pill shadow-sm me-2">
                    <i class="fas fa-download me-1"></i> Export CSV
                </a>
                <a href="{{ route('home') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
                    <i class="fas fa-home me-1"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Schedule Section -->
<div class="container-fluid jadwal-section">
    <div class="container">
        <div class="card shadow-sm">
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
                            <tr>
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
                                    <button class="btn btn-sm btn-outline-primary"
                                            data-mdb-toggle="modal"
                                            data-mdb-target="#scheduleModal{{ $event->id }}">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="scheduleModal{{ $event->id }}" tabindex="-1" aria-labelledby="scheduleModalLabel{{ $event->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white fw-bold" id="scheduleModalLabel{{ $event->id }}">
                                                {{ $event->title }}
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
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
                                                <h6 class="fw-semibold mb-2">Deskripsi Kegiatan</h6>
                                                <p class="text-muted">{{ $event->description }}</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <i class="fas fa-info-circle text-primary me-2"></i>
                                                        <div>
                                                            <div class="text-muted small">Status</div>
                                                            <div>
                                                                @if($event->status == 'on_going')
                                                                    <span class="jadwal-badge badge-on_going">Berlangsung</span>
                                                                @elseif($event->status == 'completed')
                                                                    <span class="jadwal-badge badge-completed">Selesai</span>
                                                                @elseif($event->status == 'cancelled')
                                                                    <span class="jadwal-badge badge-cancelled">Dibatalkan</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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

                                            <div class="mt-3 pt-3 border-top">
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
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary rounded-pill" data-mdb-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            @if($events->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    <div class="jadwal-empty">
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

<!-- MDBootstrap JS (jika belum dimasukkan di layout utama) -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
@endsection
