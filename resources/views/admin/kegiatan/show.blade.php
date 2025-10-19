
@extends('templates.app2')

@section('title', 'Detail Kegiatan - Organisasi')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Detail Kegiatan</h2>
        <div>
            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="card shadow-2-strong">
        <div class="card-header bg-light">
            <h5 class="mb-0">Informasi Kegiatan</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Judul Kegiatan:</div>
                <div class="col-md-9">{{ $kegiatan->title }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Tanggal:</div>
                <div class="col-md-9">{{ $kegiatan->date ? $kegiatan->date->format('d M Y') : '' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Waktu:</div>
                <div class="col-md-9">{{ $kegiatan->start_time ?? '' }} - {{ $kegiatan->end_time ?? '' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Penanggung Jawab:</div>
                <div class="col-md-9">{{ $kegiatan->user ? $kegiatan->user->name : '' }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Status:</div>
                <div class="col-md-9">
                    <span class="badge bg-{{ $kegiatan->status == 'selesai' ? 'success' : ($kegiatan->status == 'on_going' ? 'warning' : 'secondary') }}">
                        {{ ucfirst($kegiatan->status) }}
                    </span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-3 fw-bold">Deskripsi:</div>
                <div class="col-md-9">{{ $kegiatan->description }}</div>
            </div>
        </div>
    </div>

    @if($kegiatan->daily_activity_photos && count($kegiatan->daily_activity_photos) > 0)
    <div class="card shadow-2-strong mt-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Dokumentasi Kegiatan</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                @foreach($kegiatan->daily_activity_photos as $photo)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" class="card-img-top" alt="Dokumentasi">
                        <div class="card-body p-2">
                            <p class="card-text small">{{ $photo->description ?? 'Tidak ada keterangan' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
