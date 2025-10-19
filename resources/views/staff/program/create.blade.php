@extends('templates.staff')

@section('title', 'Tambah Program Kerja')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3 animate__animated animate__fadeInDown">
        <div>
            <h4 class="fw-bold text-primary mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Program Kerja</h4>
            <p class="text-muted mb-0">Isi informasi program kerja yang akan dibuat</p>
        </div>
        <a href="{{ route('staff.program.index') }}" class="btn btn-light animate__animated animate__fadeInRight">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--info-color), #20c997);">
            <h5 class="mb-0 fw-bold">Form Program Kerja</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('staff.program.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Program</label>
                        <input type="text" class="form-control @error('nama_program') is-invalid @enderror" 
                               name="nama_program" value="{{ old('nama_program') }}" required>
                        @error('nama_program')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                            <option value="">Pilih Status</option>
                            <option value="on_going" {{ old('status') == 'on_going' ? 'selected' : '' }}>Sedang Berjalan</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control @error('tgl_mulai') is-invalid @enderror" 
                               name="tgl_mulai" value="{{ old('tgl_mulai') }}" required>
                        @error('tgl_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" class="form-control @error('tgl_selesai') is-invalid @enderror" 
                               name="tgl_selesai" value="{{ old('tgl_selesai') }}" required>
                        @error('tgl_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2 animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
                    <a href="{{ route('staff.program.index') }}" class="btn btn-light btn-lg px-4">
                        <i class="fas fa-times me-2"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-primary btn-lg px-4">
                        <i class="fas fa-save me-2"></i>Simpan Program
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection