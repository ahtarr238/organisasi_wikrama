@extends('templates.app2')

@section('title', 'Tambah Galeri - Admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Galeri Baru</h5>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.galery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Galeri</label>
                    <input type="text" name="title" class="form-control" placeholder="Masukkan Judul Galeri" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="osis">OSIS</option>
                        <option value="mpk">MPK</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Masukkan Deskripsi" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="photo_url" class="form-control" accept="image/jpeg, image/jpg, image/png, image/webp, image/svg" required>
                    <div class="form-text">Format yang diterima: JPG, JPEG, PNG, WEBP, SVG (Maksimal 2MB)</div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.galery.index') }}" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection