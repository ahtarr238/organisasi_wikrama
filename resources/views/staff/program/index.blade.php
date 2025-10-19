@extends('templates.staff')

@section('title', 'Program Kerja')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3 animate__animated animate__fadeInDown">
            <div>
                <h4 class="mb-0 fw-bold text-primary"><i class="fas fa-tasks me-2"></i>Program Kerja</h4>
                <p class="text-muted mb-0">Kelola semua program kerja organisasi</p>
            </div>
            <div>
                <a href="{{ route('staff.program.export') }}" class="btn btn-success btn-sm me-2 animate__animated animate__fadeInRight">
                    <i class="fas fa-download me-2"></i>Export CSV
                </a>
                <a href="{{ route('staff.program.trash') }}" class="btn btn-info btn-sm me-2 animate__animated animate__fadeInRight" style="animation-delay: 0.1s">
                    <i class="fas fa-trash me-2"></i>Data Dihapus
                </a>
                <a href="{{ route('staff.program.create') }}" class="btn btn-primary btn-sm animate__animated animate__fadeInRight" style="animation-delay: 0.2s">
                    <i class="fas fa-plus me-2"></i>Tambah Program
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
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--info-color), #20c997);">
            <h5 class="mb-0 fw-bold">Daftar Program Kerja</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Program</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programs as $index => $program)
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $index * 0.05 }}s">
                            <td class="fw-medium">{{ $index + 1 }}</td>
                            <td class="fw-medium">{{ $program->nama_program }}</td>
                            <td>{{ date('d M Y', strtotime($program->tgl_mulai)) }}</td>
                            <td>{{ date('d M Y', strtotime($program->tgl_selesai)) }}</td>
                            <td>
                                @switch($program->status)
                                    @case('on_going')
                                        <span class="badge bg-warning text-dark px-3 py-2">Sedang Berjalan</span>
                                        @break
                                    @case('completed')
                                        <span class="badge bg-success px-3 py-2">Selesai</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge bg-danger px-3 py-2">Dibatalkan</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('staff.program.edit', $program->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('staff.program.destroy', $program->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-5">Tidak ada data program kerja</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection