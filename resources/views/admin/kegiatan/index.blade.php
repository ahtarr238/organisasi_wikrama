
@extends('templates.app2')

@section('title', 'Monitoring Kegiatan - Organisasi')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
        <div>
            <h4 class="fw-bold text-primary mb-0"><i class="fas fa-calendar-check me-2"></i>Monitoring Kegiatan</h4>
            <p class="text-muted mb-0">Pantau semua kegiatan organisasi</p>
        </div>
        <div>
            <a href="{{ route('admin.kegiatan.export') }}" class="btn btn-success btn-sm me-2 animate__animated animate__fadeInRight">
                <i class="fas fa-file-excel me-2"></i>Export Excel
            </a>
            <a href="{{ route('admin.kegiatan.trash') }}" class="btn btn-info btn-sm me-2 animate__animated animate__fadeInRight" style="animation-delay: 0.1s">
                <i class="fas fa-trash me-2"></i>Data Dihapus
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm animate__animated animate__fadeInRight" style="animation-delay: 0.2s">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--success-color), #20c997);">
            <h5 class="mb-0 fw-bold">Data Kegiatan</h5>
        </div>
        <div class="card-body p-0">
            <div class="p-3 d-flex justify-content-between align-items-center">
                <span class="text-muted">Menampilkan {{ count($kegiatans ?? []) }} data kegiatan</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul Kegiatan</th>
                            <th>Tanggal</th>
                            <th>Penanggung Jawab</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kegiatans ?? [] as $index => $kegiatan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $kegiatan->title }}</td>
                                <td>{{ $kegiatan->date ? $kegiatan->date->format('d M Y') : '' }}</td>
                                <td>{{ $kegiatan->user ? $kegiatan->user->name : '' }}</td>
                                <td>
                                    <span class="badge bg-{{ $kegiatan->status == 'selesai' ? 'success' : ($kegiatan->status == 'on_going' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($kegiatan->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.kegiatan.show', $kegiatan->id) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $kegiatan->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="deleteModal{{ $kegiatan->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $kegiatan->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $kegiatan->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus kegiatan "{{ $kegiatan->title }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.kegiatan.destroy', $kegiatan->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada data kegiatan</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
