@extends('templates.app')

@section('content')
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1F3984;
            --secondary-color: #4A6FE3;
            --accent-color: #FFC107;
            --light-color: #f0f8ff;
            --dark-color: #1a1a2e;
        }

        body {
            background-color: var(--light-color);
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--light-color) 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><circle cx="25" cy="25" r="10" fill="none" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/><circle cx="75" cy="75" r="10" fill="none" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/></svg>');
            background-size: 100px 100px;
            z-index: -1;
        }

        .login-card {
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(31, 45, 61, 0.1);
            overflow: hidden;
        }

        .login-left {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><circle cx="50" cy="50" r="40" fill="none" stroke="%23ffffff" stroke-width="0.5" opacity="0.2"/></svg>');
            background-size: 100px 100px;
            z-index: 1;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(31, 57, 132, 0.25);
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(31, 57, 132, 0.3);
        }

        .section-title {
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--accent-color);
            border-radius: 2px;
        }
    </style>

    <div class="login-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card login-card border-0">
                        <div class="row g-0">
                            <div class="col-md-5 d-none d-md-flex align-items-center justify-content-center login-left rounded-start">
                                <div class="text-center text-white px-3 position-relative" style="z-index: 2;">
                                    <img src="{{ asset('images/wikrama-logo.png') }}" alt="Logo" height="70" class="mb-3">
                                    <h4 class="fw-bold">Selamat Datang</h4>
                                    <p class="small">Masuk untuk mengelola akun organisasi</p>
                                </div>
                            </div>

                            <div class="col-md-7 bg-white">
                                <div class="card-body p-4 p-md-5">
                                    <h3 class="mb-4 fw-bold section-title" style="color: var(--primary-color);">Masuk</h3>
                                    <p class="text-muted mb-4">Masukkan alamat email dan kata sandi Anda untuk mengakses sistem.</p>

                                    <form method="POST" action="{{ route('login.process') }}" novalidate>
                                        @csrf

                                        <div class="mb-3">
                                            <label for="email" class="form-label small fw-semibold">Alamat email</label>
                                            <input type="email" id="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}" required autofocus>
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label small fw-semibold">Kata sandi</label>
                                            <input type="password" id="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" required>
                                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label small" for="remember">Ingat saya</label>
                                            </div>
                                            <div>
                                                <a href="#" class="small" style="color: var(--primary-color);">Lupa kata sandi?</a>
                                            </div>
                                        </div>

                                        @if($errors->any())
                                            <div class="alert alert-danger small py-2 mb-4" data-aos="fade-down">
                                                {{ $errors->first() }}
                                            </div>
                                        @endif

                                        <button type="submit" class="btn btn-primary w-100 text-white">
                                            Masuk
                                        </button>

                                        <div class="text-center mt-4">
                                            <p class="small mb-0">Belum punya akun? <a href="{{ route('sign-up') }}" style="color: var(--primary-color); font-weight: 600;">Daftar</a></p>
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

    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
@endsection