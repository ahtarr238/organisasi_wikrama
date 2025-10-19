@extends('templates.app')

@section('content')
<script>
    // Redirect ke halaman utama jadwal karena detail sekarang ditampilkan di modal
    window.location.href = "{{ route('schedule') }}";
</script>
@endsection
