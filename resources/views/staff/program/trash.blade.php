@extends('templates.staff')

@section('title', 'Program Kerja yang Dihapus')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3 animate__animated animate__fadeInDown">
            <h4 class="mb-0 fw-bold text-primary"><i class="fas fa-trash-alt me-2"></i>Program Kerja yang Dihapus</h4>
            <div>
                <a href="{{route('staff.program.index')}}" class="btn btn-secondary btn-sm me-2 animate__animated animate__fadeInRight">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold">Daftar Program Kerja yang Dihapus</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Program</th>
                            <th>Deskripsi</th>
                            <th>Periode</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($programs as $index => $program)
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $index * 0.05 }}s">
                            <td class="fw-medium">{{ $index + 1 }}</td>
                            <td class="fw-medium">{{ $program->nama_program }}</td>
                            <td>{{ Str::limit($program->deskripsi, 50) }}</td>
                            <td>{{ is_string($program->tgl_mulai) ? date('d M Y', strtotime($program->tgl_mulai)) : $program->tgl_mulai->format('d M Y') }} - {{ is_string($program->tgl_selesai) ? date('d M Y', strtotime($program->tgl_selesai)) : $program->tgl_selesai->format('d M Y') }}</td>
                            <td>
                                @if($program->status == 'on_going')
                                    <span class="badge bg-warning text-dark px-3 py-2">Berlangsung</span>
                                @elseif($program->status == 'completed')
                                    <span class="badge bg-success px-3 py-2">Selesai</span>
                                @elseif($program->status == 'cancelled')
                                    <span class="badge bg-danger px-3 py-2">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <form action="{{route('staff.program.restore', $program->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Pulihkan"
                                            onclick="return confirm('Apakah Anda yakin ingin memulihkan program ini?')">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('staff.program.forceDelete', $program->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Permanen"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus program ini secara permanen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($programs->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">Tidak ada program yang dihapus.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection