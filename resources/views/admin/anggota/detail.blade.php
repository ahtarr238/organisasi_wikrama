
@extends('templates.app2')

@section('title', 'Detail Anggota - Organisasi')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detail Anggota</h2>
        <div>
            <a href="{{ route('admin.anggota.monitoring') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-2-strong">
                <div class="card-body text-center">
                    @if($anggota->foto)
                        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto" class="rounded-circle mb-3" width="150" height="150">
                    @else
                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 150px; height: 150px;">
                            <span class="text-white fw-bold" style="font-size: 60px;">{{ substr($anggota->name, 0, 1) }}</span>
                        </div>
                    @endif
                    <h4 class="card-title">{{ $anggota->name }}</h4>
                    <p class="card-text">
                        <span class="badge bg-{{ $anggota->role == 'admin' ? 'danger' : ($anggota->role == 'staff' ? 'info' : 'primary') }} fs-6">
                            {{ ucfirst($anggota->role) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-2-strong">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Informasi Anggota</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Email:</div>
                        <div class="col-md-8">{{ $anggota->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Jenis Kelamin:</div>
                        <div class="col-md-8">{{ $anggota->gender ? ucfirst($anggota->gender) : '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal Lahir:</div>
                        <div class="col-md-8">{{ $anggota->birth_date ? $anggota->birth_date->format('d F Y') : '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Alamat:</div>
                        <div class="col-md-8">{{ $anggota->address ?? '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Tanggal Bergabung:</div>
                        <div class="col-md-8">{{ $anggota->join_date ? $anggota->join_date->format('d F Y') : '-' }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Organisasi:</div>
                        <div class="col-md-8">{{ $anggota->organization->name ?? '-' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
