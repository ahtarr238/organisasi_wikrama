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

        .signup-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, var(--light-color) 0%, #ffffff 100%);
            position: relative;
            overflow: hidden;
            padding: 40px 0;
        }

        .signup-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect width="100" height="100" fill="none"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="%231F3984" stroke-width="0.5" opacity="0.1"/></svg>');
            background-size: 100px 100px;
            z-index: -1;
        }

        .signup-card {
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(31, 45, 61, 0.1);
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(31, 57, 132, 0.25);
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

        .form-label {
            font-weight: 600;
        }

        .logo-container {
            position: relative;
            display: inline-block;
        }
    </style>

    <div class="signup-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6" data-aos="fade-up" data-aos-duration="1000">
                    <div class="card signup-card border-0">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="200">
                                <div class="logo-container">
                                    <img src="{{ asset('images/wikrama-logo.png') }}" alt="Logo" height="70" class="mb-3">
                                </div>
                                <h3 class="fw-bold" style="color: var(--primary-color);">Buat Akun Baru</h3>
                                <p class="text-muted">Bergabunglah dengan organisasi OSIS-MPR Wikrama</p>
                            </div>

                            <form method="POST" action="{{ route('sign-up.process') }}" novalidate data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama lengkap</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Alamat email</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Jenis kelamin</label>
                                        <select id="gender" name="gender"
                                            class="form-select @error('gender') is-invalid @enderror" required>
                                            <option value="">Pilih jenis kelamin</option>
                                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="birth_date" class="form-label">Tanggal lahir</label>
                                        <input type="date" id="birth_date" name="birth_date"
                                            class="form-control @error('birth_date') is-invalid @enderror"
                                            value="{{ old('birth_date') }}" required>
                                        @error('birth_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <textarea id="address" name="address" rows="3" class="form-control @error('address') is-invalid @enderror"
                                        required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="join_date" class="form-label">Tanggal bergabung</label>
                                    <input type="date" id="join_date" name="join_date"
                                        class="form-control @error('join_date') is-invalid @enderror"
                                        value="{{ old('join_date') ?? date('Y-m-d') }}" required>
                                    @error('join_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata sandi</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="password_confirmation" class="form-label">Konfirmasi kata sandi</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 text-white">
                                    Buat Akun
                                </button>

                                <div class="text-center mt-4">
                                    <p class="small mb-0">Sudah punya akun? <a href="{{ route('login') }}"
                                            style="color: var(--primary-color); font-weight: 600;">Masuk</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
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
