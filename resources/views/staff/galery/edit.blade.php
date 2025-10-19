@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Galeri</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('staff.galery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul Galeri</label>
                    <input type="text" name="title" class="form-control" value="{{ $gallery->title }}" placeholder="Masukkan Judul Galeri" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="category" class="form-control" required>
                        <option value="">Pilih Kategori</option>
                        <option value="osis" {{ $gallery->category == 'osis' ? 'selected' : '' }}>OSIS</option>
                        <option value="mpk" {{ $gallery->category == 'mpk' ? 'selected' : '' }}>MPK</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Masukkan Deskripsi" required>{{ $gallery->description }}</textarea>
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