@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3 animate__animated animate__fadeInDown">
        <h4 class="fw-bold text-primary mb-0"><i class="fas fa-trash-alt me-2"></i>Data Kegiatan yang Dihapus</h4>
        <div>
            <a href="{{route('staff.activity.index')}}" class="btn btn-secondary btn-sm me-2 animate__animated animate__fadeInRight">
                <i class="fas fa-arrow-left me-2"></i>Kembali
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
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold">Daftar Kegiatan yang Dihapus</h5>
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
                            <td>{{ is_string($event->date) ? date('d M Y', strtotime($event->date)) : $event->date->format('d M Y') }}</td>
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
                                    <form action="{{route('staff.activity.restore', $event->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success" title="Pulihkan"
                                            onclick="return confirm('Apakah Anda yakin ingin memulihkan kegiatan ini?')">
                                            <i class="fas fa-undo"></i>
                                        </button>
                                    </form>
                                    <form action="{{route('staff.activity.forceDelete', $event->id)}}" method="POST" class="d-inline">
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
                        @if($events->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">Tidak ada kegiatan yang dihapus.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection