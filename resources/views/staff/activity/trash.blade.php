@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <h4 class="fw-bold text-primary">Data Kegiatan yang Dihapus</h4>
        <div>
            <a href="{{route('staff.activity.index')}}" class="btn btn-secondary btn-sm me-2">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
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
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ Str::limit($event->description, 50) }}</td>
                        <td>{{ is_string($event->date) ? date('d M Y', strtotime($event->date)) : $event->date->format('d M Y') }}</td>
                        <td>{{ $event->start_time }} - {{ $event->end_time }}</td>
                        <td>
                            @if($event->status == 'on_going')
                                <span class="badge bg-warning">Berlangsung</span>
                            @elseif($event->status == 'completed')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($event->status == 'cancelled')
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <form action="{{route('staff.activity.restore', $event->id)}}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success mx-2"
                                    onclick="return confirm('Restore this event?')">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                            <form action="{{route('staff.activity.forceDelete', $event->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Permanently delete this event?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($events->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center text-muted">No deleted events available.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection