
@extends('templates.app2')

@section('title', 'Monitoring Anggota - Organisasi')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Monitoring Anggota</h2>
        <div>
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
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
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
                                <td>{{ $anggota->join_date ? $anggota->join_date->format('d M Y') : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.anggota.detail', $anggota->id) }}" class="btn btn-sm btn-info" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" title="Hapus" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $anggota->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>

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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">Belum ada data anggota</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
