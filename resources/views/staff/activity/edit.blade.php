@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Edit Kegiatan</h5>
        </div>
        <div class="card-body">
            <form action="/staff/activity/update/{{ $event->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul Aktivitas / Kegiatan</label>
                    <input type="text" name="title" value="{{ $event->title }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tanggal Kegiatan</label>
                    <input type="date" name="date" class="form-control" value="{{ $event->date->format('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Waktu Mulai Kegiatan</label>
                    <input type="time" name="start_time" class="form-control" value="{{ $event->start_time }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Waktu Selesai Kegiatan</label>
                    <input type="time" name="end_time" class="form-control" value="{{ $event->end_time }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="">Pilih Status</option>
                        <option value="on_going" {{ $event->status == 'on_going' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="completed" {{ $event->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ $event->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="/staff/activity" class="btn btn-light me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
