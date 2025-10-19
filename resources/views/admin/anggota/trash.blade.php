@extends('templates.app2')

@section('title', 'Anggota yang Dihapus - Organisasi')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInDown">
        <div>
            <h4 class="fw-bold text-primary mb-0"><i class="fas fa-trash me-2"></i>Anggota yang Dihapus</h4>
            <p class="text-muted mb-0">Kelola semua data anggota yang telah dihapus</p>
        </div>
        <div>
            <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary btn-sm animate__animated animate__fadeInRight">
                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Anggota
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

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--danger-color), #e53935);">
            <h5 class="mb-0 fw-bold">Data Anggota yang Dihapus</h5>
        </div>
        <div class="card-body p-0">
            <div class="p-3 d-flex justify-content-between align-items-center">
                <span class="text-muted">Menampilkan {{ count($anggotas ?? []) }} data anggota yang dihapus</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Organisasi</th>
                            <th>Peran</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($anggotas as $index => $anggota)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($anggota->foto)
                                    <img src="{{ asset('storage/' . $anggota->foto) }}" 
                                         class="rounded-circle" 
                                         alt="{{ $anggota->name }}" 
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/default-avatar.png') }}" 
                                         class="rounded-circle" 
                                         alt="Default Avatar" 
                                         style="width: 40px; height: 40px; object-fit: cover;">
                                @endif
                            </td>
                            <td>{{ $anggota->name }}</td>
                            <td>{{ $anggota->email }}</td>
                            <td>{{ $anggota->organization ? $anggota->organization->name : '-' }}</td>
                            <td>
                                @if($anggota->role == 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @elseif($anggota->role == 'staff')
                                    <span class="badge bg-info">Staff</span>
                                @else
                                    <span class="badge bg-primary">Member</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <form action="{{route('admin.anggota.restore', $anggota->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Pulihkan"
                                            onclick="return confirm('Apakah Anda yakin ingin memulihkan anggota ini?')">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('admin.anggota.forceDelete', $anggota->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus Permanen"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini secara permanen?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($anggotas->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-3x mb-3 text-muted"></i>
                                <p class="mb-0">Tidak ada data anggota yang dihapus</p>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    @if($anggotas->isEmpty())
    <div class="card shadow-sm animate__animated animate__fadeIn mt-4">
        <div class="card-body text-center py-5">
            <i class="fas fa-inbox fa-4x mb-3 text-muted opacity-75"></i>
            <h5 class="mb-3">Tidak ada data anggota yang dihapus</h5>
            <p class="text-muted mb-4">Belum ada anggota yang dihapus. Semua data anggota masih tersimpan dengan baik.</p>
            <a href="{{ route('admin.anggota.index') }}" class="btn btn-primary">
                <i class="fas fa-users me-2"></i>Lihat Daftar Anggota
            </a>
        </div>
    </div>
    @endif
</div>
@endsection