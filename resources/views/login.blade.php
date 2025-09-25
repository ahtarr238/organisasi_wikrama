@extends('templates.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center" style="background-color: #f1f4fb;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="row g-0">
                        <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center" style="background: linear-gradient(180deg,#1F3984,#2b4aa8); border-top-left-radius: .75rem; border-bottom-left-radius: .75rem;">
                            <div class="text-center text-white px-3">
                                <img src="{{ asset('images/wikrama-logo.png') }}" alt="Logo" height="70" class="mb-3">
                                <h4 class="fw-bold">Selamat Datang</h4>
                                <p class="small">Masuk untuk mengelola akun organisasi</p>
                            </div>
                        </div>

                        <div class="col-md-7">
                            <div class="card-body p-4 p-md-5">
                                <h3 class="mb-3 fw-bold" style="color:#1F3984;">Masuk</h3>
                                <p class="text-muted small mb-4">Masukkan alamat email dan kata sandi Anda.</p>

                                <form method="POST" action="{{ route('login.process') }}" novalidate>
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label small">Alamat email</label>
                                        <input type="email" id="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required autofocus>
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label small">Kata sandi</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password')<div class="invalid-feedback ">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label small" for="remember">Ingat saya</label>
                                        </div>
                                        <div>
                                            <a href="#" class="small" style="color:#1F3984;">Lupa kata sandi?</a>
                                        </div>
                                    </div>

                                    @if($errors->any())
                                        <div class="alert alert-danger small py-2">
                                            {{ $errors->first() }}
                                        </div>
                                    @endif

                                    <button type="submit" class="btn w-100 text-white fw-semibold" style="background-color:#1F3984;">
                                        Masuk
                                    </button>

                                    <div class="text-center mt-3">
                                        <p class="small mb-0">Belum punya akun? <a href="{{ route('sign-up') }}" style="color:#1F3984;">Daftar</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- row g-0 -->
                </div> <!-- card -->
            </div>
        </div>
    </div>
</div>
@endsection