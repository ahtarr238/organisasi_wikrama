@extends('templates.app')

@section('content')
    <div class="min-vh-100 d-flex align-items-center" style="background-color: #f1f4fb;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <img src="{{ asset('images/wikrama-logo.png') }}" alt="Logo" height="70"
                                    class="mb-2">
                                <h3 class="fw-bold" style="color:#1F3984;">Daftar</h3>
                                <p class="small text-muted">Buat akun untuk mengelola organisasi</p>
                            </div>

                            <form method="POST" action="{{ route('sign-up.process') }}" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label small">Nama lengkap</label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                        required autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label small">Alamat email</label>
                                    <input type="email" id="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row g-2">
                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label small">Jenis kelamin</label>
                                        <select id="gender" name="gender"
                                            class="form-select @error('gender') is-invalid @enderror" required>
                                            <option value="">Pilih jenis kelamin</option>
                                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                        @error('gender')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="birth_date" class="form-label small">Tanggal lahir</label>
                                        <input type="date" id="birth_date" name="birth_date"
                                            class="form-control @error('birth_date') is-invalid @enderror"
                                            value="{{ old('birth_date') }}" required>
                                        @error('birth_date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label small">Alamat</label>
                                    <textarea id="address" name="address" rows="3" class="form-control @error('address') is-invalid @enderror"
                                        required>{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3">
                                        <label for="password" class="form-label small">Kata sandi</label>
                                        <input type="password" id="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <button type="submit" class="btn w-100 text-white fw-semibold mt-3"
                                    style="background-color:#1F3984;">
                                    Buat akun
                                </button>

                                <div class="text-center mt-3">
                                    <p class="small mb-0">Sudah punya akun? <a href="{{ route('login') }}"
                                            style="color:#1F3984;">Masuk</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
