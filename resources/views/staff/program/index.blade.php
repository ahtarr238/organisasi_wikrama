@extends('templates.staff')

@section('title', 'Program Kerja')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="d-flex justify-content-between align-items-center mb-4 mt-3">
            <h4 class="mb-0 fw-bold text-primary">Program Kerja</h4>
                        <a href="{{ route('staff.program.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-2"></i>Tambah Program
            </a>
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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Program</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($programs as $index => $program)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $program->nama_program }}</td>
                            <td>{{ date('d M Y', strtotime($program->tgl_mulai)) }}</td>
                            <td>{{ date('d M Y', strtotime($program->tgl_selesai)) }}</td>
                            <td>
                                @switch($program->status)
                                    @case('on_going')
                                        <span class="badge badge-warning bg-warning text-dark">Sedang Berjalan</span>
                                        @break
                                    @case('completed')
                                        <span class="badge badge-success bg-success">Selesai</span>
                                        @break
                                    @case('cancelled')
                                        <span class="badge badge-danger bg-danger">Dibatalkan</span>
                                        @break
                                @endswitch
                            </td>
                            <td>
                                <a href="{{ route('staff.program.edit', $program->id) }}" class="btn btn-sm btn-info text-white mx-2">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('staff.program.destroy', $program->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus program ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data program kerja</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection