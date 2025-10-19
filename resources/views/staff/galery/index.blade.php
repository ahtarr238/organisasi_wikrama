@extends('templates.staff')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <h4 class="fw-bold text-primary">Galeri</h4>
        <div>
            <a href="{{route('staff.galery.export')}}" class="btn btn-success btn-sm me-2">
                <i class="fas fa-download me-2"></i>Export CSV
            </a>
            <a href="{{route('staff.galery.trash')}}" class="btn btn-info btn-sm me-2">
                <i class="fas fa-trash me-2"></i>Data Dihapus
            </a>
            <a href="{{route('staff.galery.create')}}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-2"></i>Tambah Galeri
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                @foreach ($galleries as $index => $gallery)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($gallery->photo_url)
                            <img src="{{ Storage::url('galery/' . $gallery->photo_url) }}" class="card-img-top" alt="{{ $gallery->title }}" style="height:400px;">
                        @else
                            <img src="https://mdbootstrap.com/img/new/standard/nature/184.jpg" class="card-img-top" alt="Placeholder" style="height: 400px; ">
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
                                    <a href="{{ route('staff.galery.edit', $gallery->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('staff.galery.destroy', $gallery->id) }}" method="POST" class="d-inline">
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
                <div class="col-12 text-center text-muted py-5">
                    <i class="fas fa-images fa-3x mb-3"></i>
                    <p>Belum ada galeri yang tersedia.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection