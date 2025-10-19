@extends('templates.app2')

@section('title', 'Anggota yang Dihapus - Organisasi')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Anggota yang Dihapus</h2>
        <div>
            <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary me-2">
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
</div>
@endsection