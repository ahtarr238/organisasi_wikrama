@extends('templates.staff')

@section('title', 'Program Kerja yang Dihapus')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <h4 class="mb-0 fw-bold text-primary">Program Kerja yang Dihapus</h4>
            <div>
                <a href="{{route('staff.program.index')}}" class="btn btn-secondary btn-sm me-2">
                    <i class="fas fa-arrow-left me-2"></i>Kembali
                </a>
            </div>
        </div>

    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Program</th>
                        <th>Deskripsi</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programs as $index => $program)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $program->nama_program }}</td>
                        <td>{{ Str::limit($program->deskripsi, 50) }}</td>
                        <td>{{ is_string($program->tgl_mulai) ? date('d M Y', strtotime($program->tgl_mulai)) : $program->tgl_mulai->format('d M Y') }} - {{ is_string($program->tgl_selesai) ? date('d M Y', strtotime($program->tgl_selesai)) : $program->tgl_selesai->format('d M Y') }}</td>
                        <td>
                            @if($program->status == 'on_going')
                                <span class="badge bg-warning">Berlangsung</span>
                            @elseif($program->status == 'completed')
                                <span class="badge bg-success">Selesai</span>
                            @elseif($program->status == 'cancelled')
                                <span class="badge bg-danger">Dibatalkan</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <form action="{{route('staff.program.restore', $program->id)}}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success mx-2"
                                    onclick="return confirm('Restore this program?')">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                            <form action="{{route('staff.program.forceDelete', $program->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Permanently delete this program?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @if($programs->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center text-muted">No deleted programs available.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection