
@extends('templates.app2')

@section('title', 'Kelola Anggota - Organisasi')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
        <div>
            <h4 class="fw-bold text-primary mb-0"><i class="fas fa-users me-2"></i>Daftar Anggota</h4>
            <p class="text-muted mb-0">Kelola semua data anggota organisasi</p>
        </div>
        <div>
            <a href="{{ route('admin.anggota.export') }}" class="btn btn-success btn-sm me-2 animate__animated animate__fadeInRight">
                <i class="fas fa-file-excel me-2"></i>Export Excel
            </a>
            <a href="{{ route('admin.anggota.trash') }}" class="btn btn-info btn-sm me-2 animate__animated animate__fadeInRight" style="animation-delay: 0.1s">
                <i class="fas fa-trash me-2"></i>Trash
            </a>
            <a href="{{ route('admin.anggota.create') }}" class="btn btn-primary btn-sm animate__animated animate__fadeInRight" style="animation-delay: 0.2s">
                <i class="fas fa-plus me-2"></i>Tambah Anggota
            </a>
        </div>
    </div>

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
            <h5 class="mb-0 fw-bold">Data Anggota</h5>
        </div>
        <div class="card-body p-0">
            <div class="p-3 d-flex justify-content-between align-items-center">
                <span class="text-muted">Menampilkan {{ count($anggotas ?? []) }} data anggota</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Bergabung</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggotas ?? [] as $index => $anggota)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if($anggota->foto)
                                        <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto" class="rounded-circle" width="45" height="45">
                                    @else
                                        <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                                            <span class="text-white fw-bold">{{ substr($anggota->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $anggota->name }}</td>
                                <td>{{ $anggota->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $anggota->role == 'admin' ? 'danger' : ($anggota->role == 'staff' ? 'info' : 'primary') }}">
                                        {{ ucfirst($anggota->role) }}
                                    </span>
                                </td>
                                <td>{{ $anggota->gender ? ucfirst($anggota->gender) : '-' }}</td>
                                <td>{{ $anggota->join_date ? $anggota->join_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.anggota.show', $anggota->id) }}" class="btn btn-sm btn-outline-info" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.anggota.edit', $anggota->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $anggota->id }}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="deleteModal{{ $anggota->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $anggota->id }}" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $anggota->id }}">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus anggota "{{ $anggota->name }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <form action="{{ route('admin.anggota.destroy', $anggota->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">Belum ada data anggota</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
