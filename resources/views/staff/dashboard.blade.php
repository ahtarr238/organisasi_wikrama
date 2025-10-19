@extends('templates.staff')

@section('title', 'Dashboard Staff')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-3 mb-4 animate__animated animate__fadeInUp">
            <div class="card shadow-sm h-100" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)); color: white; border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $totalKegiatan ?? 0 }}</h2>
                            <p class="small mb-0 mt-2">Total Kegiatan</p>
                        </div>
                        <div class="align-self-center bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-calendar fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            <div class="card shadow-sm h-100" style="background: linear-gradient(45deg, var(--warning-color), #ff9800); color: white; border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $kegiatanAktif ?? 0 }}</h2>
                            <p class="small mb-0 mt-2">Kegiatan Aktif</p>
                        </div>
                        <div class="align-self-center bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <div class="card shadow-sm h-100" style="background: linear-gradient(45deg, var(--info-color), #20c997); color: white; border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $totalProgram ?? 0 }}</h2>
                            <p class="small mb-0 mt-2">Total Program</p>
                        </div>
                        <div class="align-self-center bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-tasks fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
            <div class="card shadow-sm h-100" style="background: linear-gradient(45deg, var(--success-color), #20c997); color: white; border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $programAktif ?? 0 }}</h2>
                            <p class="small mb-0 mt-2">Program Aktif</p>
                        </div>
                        <div class="align-self-center bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-play-circle fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12 mb-4 animate__animated animate__fadeInLeft">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-calendar-alt me-2"></i>Daftar Kegiatan Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="p-3 d-flex justify-content-between align-items-center">
                        <span class="text-muted">Menampilkan {{ count($kegiatanTerbaru ?? []) }} data kegiatan terbaru</span>
                        <a href="{{ route('staff.activity.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Waktu</th>
                                    <th>Penanggung Jawab</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kegiatanTerbaru ?? [] as $kegiatan)
                                    <tr>
                                        <td class="fw-medium">{{ $kegiatan->title }}</td>
                                        <td>{{ $kegiatan->date->format('d M Y') }}</td>
                                        <td>{{ $kegiatan->start_time }} - {{ $kegiatan->end_time }}</td>
                                        <td>{{ $kegiatan->user ? $kegiatan->user->name : '-' }}</td>
                                        <td>
                                            @if($kegiatan->status == 'on_going')
                                                <span class="badge bg-warning text-dark px-3 py-2">Berlangsung</span>
                                            @elseif($kegiatan->status == 'completed')
                                                <span class="badge bg-success px-3 py-2">Selesai</span>
                                            @elseif($kegiatan->status == 'cancelled')
                                                <span class="badge bg-danger px-3 py-2">Dibatalkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">Belum ada kegiatan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4 animate__animated animate__fadeInRight">
            <div class="card shadow-sm">
                <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--info-color), #20c997);">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-tasks me-2"></i>Program Kerja Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="p-3 d-flex justify-content-between align-items-center">
                        <span class="text-muted">Menampilkan {{ count($programTerbaru ?? []) }} data program terbaru</span>
                        <a href="{{ route('staff.program.index') }}" class="btn btn-sm btn-info">Lihat Semua</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nama Program</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Pembuat</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($programTerbaru ?? [] as $program)
                                    <tr>
                                        <td class="fw-medium">{{ $program->nama_program }}</td>
                                        <td>{{ date('d M Y', strtotime($program->tgl_mulai)) }}</td>
                                        <td>{{ date('d M Y', strtotime($program->tgl_selesai)) }}</td>
                                        <td>{{ $program->creator ? $program->creator->name : '-' }}</td>
                                        <td>
                                            @if($program->status == 'on_going')
                                                <span class="badge bg-warning text-dark px-3 py-2">Sedang Berjalan</span>
                                            @elseif($program->status == 'completed')
                                                <span class="badge bg-success px-3 py-2">Selesai</span>
                                            @elseif($program->status == 'cancelled')
                                                <span class="badge bg-danger px-3 py-2">Dibatalkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5">Belum ada program kerja</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
