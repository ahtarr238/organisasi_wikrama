@extends('templates.staff')

@php
use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3 animate__animated animate__fadeInDown">
        <h4 class="fw-bold text-primary mb-0"><i class="fas fa-trash-alt me-2"></i>Galeri yang Dihapus</h4>
        <div>
            <a href="{{route('staff.galery.index')}}" class="btn btn-secondary btn-sm me-2 animate__animated animate__fadeInRight">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Foto</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($galleries as $index => $gallery)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $gallery->title }}</td>
                        <td>
                            @if($gallery->category == 'osis')
                                <span class="badge bg-primary">OSIS</span>
                            @else
                                <span class="badge bg-success">MPK</span>
                            @endif
                        </td>
                        <td>{{ Str::limit($gallery->description, 50) }}</td>
                        <td>
                            <img src="{{ asset('storage/galery/' . $gallery->photo_url) }}" 
                                 class="img-thumbnail" 
                                 alt="{{ $gallery->title }}" 
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </td>
                        <td class="text-end">
                            <form action="{{route('staff.galery.restore', $gallery->id)}}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success mx-2"
                                    onclick="return confirm('Restore this gallery?')">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                            <form action="{{route('staff.galery.forceDelete', $gallery->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Permanently delete this gallery?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($galleries->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-muted">No deleted galleries available.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection