@extends('templates.app2')

@section('title', 'Dashboard Admin - Organisasi')

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary text-white shadow-2-strong">
                <div class="card-body">
                    <h5 class="card-title">Total Anggota</h5>
                    <h3>{{ $totalAnggota ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success text-white shadow-2-strong">
                <div class="card-body">
                    <h5 class="card-title">Total Kegiatan</h5>
                    <h3>{{ $totalKegiatan ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning text-dark shadow-2-strong">
                <div class="card-body">
                    <h5 class="card-title">Total Galeri</h5>
                    <h3>{{ $totalGaleri ?? 0 }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-danger text-white shadow-2-strong">
                <div class="card-body">
                    <h5 class="card-title">Total User</h5>
                    <h3>{{ $totalUser ?? 0 }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-2-strong mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Kegiatan Terbaru</h5>
        </div>
        <div class="card-body">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Penanggung Jawab</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kegiatanTerbaru ?? [] as $kegiatan)
                        <tr>
                            <td>{{ $kegiatan->judul }}</td>
                            <td>{{ $kegiatan->tanggal }}</td>
                            <td>{{ $kegiatan->penanggung_jawab }}</td>
                            <td>
                                <span class="badge bg-{{ $kegiatan->status == 'selesai' ? 'success' : 'warning' }}">
                                    {{ ucfirst($kegiatan->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada kegiatan terbaru</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow-2-strong">
        <div class="card-header bg-light">
            <h5 class="mb-0">Anggota Aktif</h5>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @forelse($anggotaAktif ?? [] as $anggota)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto" class="rounded-circle me-3" width="45" height="45">
                            <div>
                                <p class="fw-bold mb-0">{{ $anggota->nama }}</p>
                                <p class="text-muted mb-0">{{ $anggota->jabatan }}</p>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">Aktif</span>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted">Belum ada anggota aktif</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
