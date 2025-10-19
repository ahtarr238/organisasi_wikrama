@extends('templates.app2')

@section('title', 'Dashboard Admin - Organisasi')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-3 mb-4 animate__animated animate__fadeInUp">
            <div class="card shadow-sm h-100" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color)); color: white; border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $totalAnggota ?? 0 }}</h2>
                            <p class="small mb-0 mt-2">Total Anggota</p>
                        </div>
                        <div class="align-self-center bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            <div class="card shadow-sm h-100" style="background: linear-gradient(45deg, var(--success-color), #20c997); color: white; border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $totalKegiatan ?? 0 }}</h2>
                            <p class="small mb-0 mt-2">Total Kegiatan</p>
                        </div>
                        <div class="align-self-center bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-calendar-check fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <div class="card shadow-sm h-100" style="background: linear-gradient(45deg, var(--warning-color), #ff9800); color: white; border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $totalGaleri ?? 0 }}</h2>
                            <p class="small mb-0 mt-2">Total Galeri</p>
                        </div>
                        <div class="align-self-center bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-image fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
            <div class="card shadow-sm h-100" style="background: linear-gradient(45deg, var(--danger-color), #c82333); color: white; border-radius: 15px; overflow: hidden;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0 fw-bold">{{ $totalUser ?? 0 }}</h2>
                            <p class="small mb-0 mt-2">Total User</p>
                        </div>
                        <div class="align-self-center bg-white bg-opacity-25 rounded-circle p-3">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="progress" style="height: 5px; background-color: rgba(255,255,255,0.2);">
                    <div class="progress-bar bg-white" role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>



    <div class="card shadow-sm animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
            <h5 class="mb-0 fw-bold">Anggota Aktif</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse($anggotaAktif ?? [] as $anggota)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if($anggota->foto)
                                <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto" class="rounded-circle me-3" width="45" height="45">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <span class="text-white fw-bold">{{ substr($anggota->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <p class="fw-bold mb-0">{{ $anggota->name }}</p>
                                <p class="text-muted mb-0">
                                    <span class="badge bg-{{ $anggota->role == 'admin' ? 'danger' : ($anggota->role == 'staff' ? 'info' : 'primary') }} me-1">
                                        {{ ucfirst($anggota->role) }}
                                    </span>
                                    {{ $anggota->join_date ? $anggota->join_date->format('d M Y') : '' }}
                                </p>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">Aktif</span>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted">Belum ada anggota aktif</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
