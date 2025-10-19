@extends('templates.staff')

@section('title', 'Edit Program Kerja')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 animate__animated animate__fadeInDown">
        <div class="col-12">
            <h2 class="mb-0 fw-bold text-primary"><i class="fas fa-edit me-2"></i>Edit Program Kerja</h2>
        </div>
    </div>

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
            <h5 class="mb-0 fw-bold">Edit Program Kerja</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('staff.program.update', $program->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Program</label>
                        <input type="text" class="form-control @error('nama_program') is-invalid @enderror" 
                               name="nama_program" value="{{ old('nama_program', $program->nama_program) }}" required>
                        @error('nama_program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="on_going" {{ old('status', $program->status) == 'on_going' ? 'selected' : '' }}>Sedang Berjalan</option>
                            <option value="completed" {{ old('status', $program->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ old('status', $program->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              name="deskripsi" rows="4" required>{{ old('deskripsi', $program->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" 
                               name="tgl_mulai" value="{{ old('tgl_mulai', date('Y-m-d', strtotime($program->tgl_mulai))) }}" required>
                        @error('tgl_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" 
                               name="tgl_selesai" value="{{ old('tgl_selesai', date('Y-m-d', strtotime($program->tgl_selesai))) }}" required>
                        @error('tgl_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 mt-4 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
                    <a href="{{ route('staff.program.index') }}" class="btn btn-light btn-lg px-4">
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