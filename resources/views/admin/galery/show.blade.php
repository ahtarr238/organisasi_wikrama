@extends('templates.app2')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('title', 'Detail Galeri - Admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Detail Galeri</h5>
            <div>
                <a href="{{ route('admin.galery.edit', $gallery->id) }}" class="btn btn-sm btn-light me-2">
                    <i class="fas fa-edit me-1"></i> Edit
                </a>
                <form action="{{ route('admin.galery.destroy', $gallery->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus galeri ini?')">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-4">
                    @if($gallery->photo_url)
                        <img src="{{ Storage::url('galery/' . $gallery->photo_url) }}" class="img-fluid rounded" alt="{{ $gallery->title }}">
                    @else
                        <img src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" class="img-fluid rounded" alt="Placeholder">
                    @endif
                </div>
                <div class="col-md-6">
                    <h4 class="mb-3">{{ $gallery->title }}</h4>
                    <div class="mb-3">
                        <span class="badge bg-primary fs-6">{{ strtoupper($gallery->category) }}</span>
                    </div>
                    <p class="mb-3">{{ $gallery->description }}</p>
                    <div class="text-muted small mb-2">
                        <i class="fas fa-user me-1"></i> Diunggah oleh: {{ $gallery->uploader->name ?? 'Unknown' }}
                    </div>
                    <div class="text-muted small">
                        <i class="fas fa-calendar me-1"></i> Tanggal: {{ $gallery->uploaded_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.galery.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Galeri
                </a>
            </div>
        </div>
    </div>
</div>
@endsection