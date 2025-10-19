@extends('templates.app2')

@section('title', 'Kegiatan yang Dihapus - Organisasi')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Kegiatan yang Dihapus</h2>
        <div>
            <a href="{{ route('admin.kegiatan.index') }}" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Kegiatan
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show animate__animated animate__fadeIn" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-2-strong">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Kegiatan</th>
                            <th>Pelaksana</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatans as $index => $kegiatan)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $kegiatan->title }}</td>
                            <td>{{ $kegiatan->user ? $kegiatan->user->name : '-' }}</td>
                            <td>{{ $kegiatan->date ? $kegiatan->date->format('d M Y') : '-' }}</td>
                            <td>
                                @if($kegiatan->status == 'selesai')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($kegiatan->status == 'berlangsung')
                                    <span class="badge bg-primary">Berlangsung</span>
                                @else
                                    <span class="badge bg-warning">Dijadwalkan</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <form action="{{route('admin.kegiatan.restore', $kegiatan->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Pulihkan"
                                            onclick="return confirm('Apakah Anda yakin ingin memulihkan kegiatan ini?')">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('admin.kegiatan.forceDelete', $kegiatan->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Permanen"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini secara permanen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($kegiatans->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                <p class="mb-0">Tidak ada data kegiatan yang dihapus</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection