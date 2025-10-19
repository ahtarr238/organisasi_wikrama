@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
            <h5 class="mb-0 fw-bold"><i class="fas fa-edit me-2"></i>Edit Galeri</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('staff.galery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft">
                        <label class="form-label fw-bold">Judul Galeri</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                            <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" placeholder="Masukkan Judul Galeri" required>
                        </div>
                        <div class="invalid-feedback">Judul galeri harus diisi</div>
                    </div>
                    <div class="col-md-6 mb-3 animate__animated animate__fadeInRight">
                        <label class="form-label fw-bold">Kategori</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <select name="category" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="osis" {{ $gallery->category == 'osis' ? 'selected' : '' }}>OSIS</option>
                                <option value="mpk" {{ $gallery->category == 'mpk' ? 'selected' : '' }}>MPK</option>
                            </select>
                        </div>
                        <div class="invalid-feedback">Kategori harus dipilih</div>
                    </div>
                </div>
                <div class="mb-3 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                        <textarea name="description" class="form-control" rows="4" placeholder="Masukkan Deskripsi" required>{{ $gallery->description }}</textarea>
                    </div>
                    <div class="invalid-feedback">Deskripsi harus diisi</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label>
                    @if($gallery->photo_url)
                        <div class="mb-2">
                            <img src="{{ Storage::url('galery/' . $gallery->photo_url) }}" class="img-thumbnail" alt="{{ $gallery->title }}" style="max-height: 200px;">
                        </div>
                    @else
                        <div class="mb-2 text-muted">Tidak ada gambar</div>
                    @endif
                    <label class="form-label">Ganti Gambar (kosongkan jika tidak ingin mengubah)</label>
                    <input type="file" name="photo_url" class="form-control" accept="image/jpeg, image/jpg, image/png, image/webp, image/svg">
                    <div class="form-text">Format yang diterima: JPG, JPEG, PNG, WEBP, SVG (Maksimal 2MB)</div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('staff.galery.index') }}" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection