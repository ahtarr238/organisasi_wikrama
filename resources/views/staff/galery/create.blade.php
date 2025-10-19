@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3 animate__animated animate__fadeInDown">
        <div>
            <h4 class="fw-bold text-primary mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Galeri Baru</h4>
            <p class="text-muted mb-0">Unggah foto dan dokumentasi kegiatan</p>
        </div>
        <a href="{{ route('staff.galery.index') }}" class="btn btn-light animate__animated animate__fadeInRight">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>
    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--warning-color), #ff9800);">
            <h5 class="mb-0 fw-bold">Form Galeri</h5>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            <form action="{{ route('staff.galery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 animate__animated animate__fadeInLeft">
                    <label class="form-label fw-bold">Judul Galeri</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-heading"></i></span>
                        <input type="text" name="title" class="form-control" placeholder="Masukkan Judul Galeri" required>
                    </div>
                </div>
                <div class="mb-3 animate__animated animate__fadeInRight" style="animation-delay: 0.1s">
                    <label class="form-label fw-bold">Kategori</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-tag"></i></span>
                        <select name="category" class="form-select" required>
                            <option value="">Pilih Kategori</option>
                            <option value="osis">OSIS</option>
                            <option value="mpk">MPK</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                        <textarea name="description" class="form-control" rows="4" placeholder="Masukkan Deskripsi" required></textarea>
                    </div>
                </div>
                <div class="mb-3 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                    <label class="form-label fw-bold">Gambar</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-image"></i></span>
                        <input type="file" name="photo_url" class="form-control" accept="image/jpeg, image/jpg, image/png, image/webp, image/svg" required>
                    </div>
                    <div class="form-text mt-2"><i class="fas fa-info-circle me-1"></i>Format yang diterima: JPG, JPEG, PNG, WEBP, SVG (Maksimal 2MB)</div>
                </div>
                <div class="d-flex justify-content-end animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                    <a href="{{ route('staff.galery.index') }}" class="btn btn-light me-2 btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i>Simpan Galeri
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection