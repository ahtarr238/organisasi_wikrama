@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3 animate__animated animate__fadeInDown">
        <div>
            <h4 class="fw-bold text-primary mb-0"><i class="fas fa-calendar-check me-2"></i>Atur Kegiatan</h4>
            <p class="text-muted mb-0">Kelola semua kegiatan organisasi</p>
        </div>
        <div>
            <a href="{{route('staff.activity.export')}}" class="btn btn-success btn-sm me-2 animate__animated animate__fadeInRight">
                <i class="fas fa-download me-2"></i>Export CSV
            </a>
            <a href="{{route('staff.activity.trash')}}" class="btn btn-info btn-sm me-2 animate__animated animate__fadeInRight" style="animation-delay: 0.1s">
                <i class="fas fa-trash me-2"></i>Data Dihapus
            </a>
            <a href="{{route('staff.activity.create')}}" class="btn btn-primary btn-sm animate__animated animate__fadeInRight" style="animation-delay: 0.2s">
                <i class="fas fa-plus me-2"></i>Tambah Kegiatan
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show animate__animated animate__fadeInDown" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));">
            <h5 class="mb-0 fw-bold">Daftar Kegiatan</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $index => $event)
                        <tr class="animate__animated animate__fadeIn" style="animation-delay: {{ $index * 0.05 }}s">
                            <td class="fw-medium">{{ $index + 1 }}</td>
                            <td class="fw-medium">{{ $event->title }}</td>
                            <td>{{ Str::limit($event->description, 50) }}</td>
                            <td>{{ $event->date->format('d M Y') }}</td>
                            <td>{{ $event->start_time }} - {{ $event->end_time }}</td>
                            <td>
                                @if($event->status == 'on_going')
                                    <span class="badge bg-warning text-dark px-3 py-2">Berlangsung</span>
                                @elseif($event->status == 'completed')
                                    <span class="badge bg-success px-3 py-2">Selesai</span>
                                @elseif($event->status == 'cancelled')
                                    <span class="badge bg-danger px-3 py-2">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <div class="btn-group" role="group">
                                    <a href="/staff/activity/edit/{{ $event->id }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="/staff/activity/delete/{{ $event->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if($events->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">Tidak ada kegiatan tersedia.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
