@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
            <h5 class="mb-0 fw-bold"><i class="fas fa-edit me-2"></i>Edit Kegiatan</h5>
        </div>
        <div class="card-body p-4">
            <form action="/staff/activity/update/{{ $event->id }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft">
                        <label class="form-label fw-bold">Judul Aktivitas / Kegiatan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-heading"></i></span>
                            <input type="text" name="title" value="{{ $event->title }}" class="form-control" required>
                        </div>
                        <div class="invalid-feedback">Judul kegiatan harus diisi</div>
                    </div>
                    <div class="col-md-6 mb-3 animate__animated animate__fadeInRight">
                        <label class="form-label fw-bold">Tanggal Kegiatan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" name="date" class="form-control" value="{{ $event->date->format('Y-m-d') }}" required>
                        </div>
                        <div class="invalid-feedback">Tanggal kegiatan harus diisi</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft" style="animation-delay: 0.1s">
                        <label class="form-label fw-bold">Waktu Mulai Kegiatan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="time" name="start_time" class="form-control" value="{{ $event->start_time }}" required>
                        </div>
                        <div class="invalid-feedback">Waktu mulai harus diisi</div>
                    </div>
                    <div class="col-md-6 mb-3 animate__animated animate__fadeInRight" style="animation-delay: 0.1s">
                        <label class="form-label fw-bold">Waktu Selesai Kegiatan</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            <input type="time" name="end_time" class="form-control" value="{{ $event->end_time }}" required>
                        </div>
                        <div class="invalid-feedback">Waktu selesai harus diisi</div>
                    </div>
                </div>
                <div class="mb-3 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                        <textarea name="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
                    </div>
                    <div class="invalid-feedback">Deskripsi harus diisi</div>
                </div>
                <div class="mb-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                    <label class="form-label fw-bold">Status</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                        <select name="status" class="form-control" required>
                            <option value="">Pilih Status</option>
                            <option value="on_going" {{ $event->status == 'on_going' ? 'selected' : '' }}>Berlangsung</option>
                            <option value="completed" {{ $event->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>
                    <div class="invalid-feedback">Status harus dipilih</div>
                </div>
                <div class="d-flex justify-content-end animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                    <a href="/staff/activity" class="btn btn-light me-2 btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
