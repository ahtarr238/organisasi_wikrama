@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Tambah Kegiatan Baru</h5>
        </div>
        <div class="card-body">
            <form action="/staff/activity/store" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Judul Aktivitas / Kegiatan</label>
                    <input type="text" name="title" class="form-control" placeholder="Masukkan Judul Aktivitas / Kegiatan" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Kegiatan</label>
                    <input type="date" name="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Waktu Mulai Kegiatan</label>
                    <input type="time" name="start_time" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Waktu Selesai Kegiatan</label>
                    <input type="time" name="end_time" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" placeholder="Masukkan Deskripsi " required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="on_going">Berlangsung</option>
                        <option value="completed">Selesai</option>
                        <option value="cancelled">Dibatalkan</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/staff/activity" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
