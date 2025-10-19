@extends('templates.app2')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title', 'Galeri - Admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
        <div>
            <h4 class="fw-bold text-primary mb-0"><i class="fas fa-images me-2"></i>Galeri</h4>
            <p class="text-muted mb-0">Kelola semua foto dan dokumentasi kegiatan</p>
        </div>
        <div>
            <a href="{{route('admin.galery.export')}}" class="btn btn-success btn-sm me-2 animate__animated animate__fadeInRight">
                <i class="fas fa-download me-2"></i>Export CSV
            </a>
            <a href="{{route('admin.galery.trash')}}" class="btn btn-info btn-sm me-2 animate__animated animate__fadeInRight" style="animation-delay: 0.1s">
                <i class="fas fa-trash me-2"></i>Data Dihapus
            </a>
            <a href="{{route('admin.galery.create')}}" class="btn btn-primary btn-sm animate__animated animate__fadeInRight" style="animation-delay: 0.2s">
                <i class="fas fa-plus me-2"></i>Tambah Galeri
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--warning-color), #ff9800);">
            <h5 class="mb-0 fw-bold">Koleksi Galeri</h5>
        </div>
        <div class="card-body p-0">
            <div class="p-3 d-flex justify-content-between align-items-center">
                <span class="text-muted">Menampilkan {{ count($galleries ?? []) }} foto galeri</span>
            </div>
            <div class="p-3">
            <div class="row">
                @foreach ($galleries as $index => $gallery)
                <div class="col-md-4 mb-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="card h-100 shadow-sm border-0 overflow-hidden">
                        @if($gallery->photo_url)
                            <img src="{{ Storage::url('galery/' . $gallery->photo_url) }}" class="card-img-top" alt="{{ $gallery->title }}" style="height:250px; object-fit: cover;">
                        @else
                            <img src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" class="card-img-top" alt="Placeholder" style="height: 250px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $gallery->title }}</h5>
                            <p class="card-text">{{ Str::limit($gallery->description, 100) }}</p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary">{{ strtoupper($gallery->category) }}</span>
                                    <small class="text-muted">{{ $gallery->uploaded_at->format('d M Y H:i') }}</small>
                                </div>
                                <div class="text-muted small mb-3">
                                    <i class="fas fa-user me-1"></i> {{ $gallery->uploader->name ?? 'Unknown' }}
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('admin.galery.edit', $gallery->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.galery.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Hapus galeri ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if($galleries->isEmpty())
                <div class="col-12 text-center text-muted py-5 animate__animated animate__fadeIn">
                    <i class="fas fa-images fa-4x mb-3 opacity-75"></i>
                    <h5 class="mb-3">Belum ada galeri yang tersedia</h5>
                    <p>Anda belum menambahkan galeri apa pun. Mulai dengan menambahkan galeri baru.</p>
                    <a href="{{route('admin.galery.create')}}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-2"></i>Tambah Galeri Baru
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection