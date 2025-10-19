
@extends('templates.app2')

@section('title', 'Monitoring Kegiatan - Organisasi')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Monitoring Kegiatan</h2>
        <div>
            <a href="{{ route('admin.kegiatan.export') }}" class="btn btn-success me-2">
                <i class="fas fa-file-excel me-2"></i>Export Excel
            </a>
            <a href="{{ route('admin.kegiatan.trash') }}" class="btn btn-info me-2">
                <i class="fas fa-trash me-2"></i>Data Dihapus
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>

    <div class="card shadow-2-strong">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
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
                                    <a href="{{ route('admin.kegiatan.show', $kegiatan->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $kegiatan->id }}">
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
