@extends('templates.staff')

@section('title', 'Dashboard Staff')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalKegiatan ?? 0 }}</h4>
                            <p class="small mb-0">Total Kegiatan</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-calendar fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-dark shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $kegiatanAktif ?? 0 }}</h4>
                            <p class="small mb-0">Kegiatan Aktif</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-clock fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-info text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $totalProgram ?? 0 }}</h4>
                            <p class="small mb-0">Total Program</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-tasks fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="mb-0">{{ $programAktif ?? 0 }}</h4>
                            <p class="small mb-0">Program Aktif</p>
                        </div>
                        <div class="align-self-center">
                            <i class="fas fa-play-circle fa-2x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">Daftar Kegiatan Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
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
                                        <td>{{ $kegiatan->title }}</td>
                                        <td>{{ $kegiatan->date->format('d M Y') }}</td>
                                        <td>{{ $kegiatan->start_time }} - {{ $kegiatan->end_time }}</td>
                                        <td>{{ $kegiatan->user->name }}</td>
                                        <td>
                                            @if($kegiatan->status == 'on_going')
                                                <span class="badge bg-warning">Berlangsung</span>
                                            @elseif($kegiatan->status == 'completed')
                                                <span class="badge bg-success">Selesai</span>
                                            @elseif($kegiatan->status == 'cancelled')
                                                <span class="badge bg-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada kegiatan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header bg-light border-0">
                    <h5 class="mb-0">Program Kerja Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
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
                                        <td>{{ $program->nama_program }}</td>
                                        <td>{{ date('d M Y', strtotime($program->tgl_mulai)) }}</td>
                                        <td>{{ date('d M Y', strtotime($program->tgl_selesai)) }}</td>
                                        <td>{{ $program->creator->name }}</td>
                                        <td>
                                            @if($program->status == 'on_going')
                                                <span class="badge bg-warning">Sedang Berjalan</span>
                                            @elseif($program->status == 'completed')
                                                <span class="badge bg-success">Selesai</span>
                                            @elseif($program->status == 'cancelled')
                                                <span class="badge bg-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-3">Belum ada program kerja</td>
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
