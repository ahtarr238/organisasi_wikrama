@extends('templates.staff')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
        <h4 class="fw-bold text-primary">Atur Kegiatan</h4>
        <div>
            <a href="{{route('staff.activity.export')}}" class="btn btn-success btn-sm me-2">
                <i class="fas fa-download me-2"></i>Export CSV
            </a>
            <a href="{{route('staff.activity.trash')}}" class="btn btn-info btn-sm me-2">
                <i class="fas fa-trash me-2"></i>Data Dihapus
            </a>
            <a href="{{route('staff.activity.create')}}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-2"></i>Tambah Kegiatan
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
                        <td>{{ $event->date->format('d M Y') }}</td>
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
                        <td class="text-end ">
                            <a href="/staff/activity/edit/{{ $event->id }}" class="btn btn-sm btn-outline-primary mx-2">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="/staff/activity/delete/{{ $event->id }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Delete this event?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($events->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center text-muted">No events available.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
