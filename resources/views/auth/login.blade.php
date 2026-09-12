@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-12 col-sm-10 col-md-6 col-lg-4">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        @if(file_exists(public_path('images/logo.jpg')))
                            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" height="65" class="mb-3 rounded-3 shadow-sm p-1 bg-white border" style="object-fit: contain; max-width: 100%;">
                        @elseif(file_exists(public_path('images/logo.png')))
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" height="65" class="mb-3 rounded-3 shadow-sm p-1 bg-white border" style="object-fit: contain; max-width: 100%;">
                        @else
                            <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-circle p-3 mb-2">
                                <i class="bi bi-box-seam-fill fs-2"></i>
                            </div>
                        @endif
                        <h5 class="fw-bold text-dark mb-1">Selamat Datang</h5>
                        <small class="text-muted">Masuk ke akun Medify App Anda</small>
                    </div>

                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-1"></i>{{ __('Email Address') }}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope text-muted"></i></span>
                                <input id="email" type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email Anda">
                            </div>
                            @error('email')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock me-1"></i>{{ __('Password') }}
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                                <input id="password" type="password" class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
                                <button class="btn btn-outline-secondary border-start-0 bg-light px-3" type="button" id="togglePassword" title="Tampilkan/Sembunyikan Password">
                                    <i class="bi bi-eye text-secondary" id="eyeIcon"></i>
                                </button>
                            </div>
                            @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small text-primary" href="{{ route('password.request') }}">
                                    Lupa Password?
                                </a>
                            @endif
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary py-2 fw-semibold">
                                <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('Login') }}
                            </button>
                        </div>

                        @if (Route::has('register'))
                        <hr class="my-3">
                        <div class="text-center">
                            <small class="text-muted">Belum punya akun?</small>
                            <a href="{{ route('register') }}" class="text-decoration-none ms-1 fw-semibold text-primary">
                                Daftar Sekarang
                            </a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Password visibility toggle
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword && passwordInput && eyeIcon) {
            togglePassword.addEventListener('click', function () {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                
                if (isPassword) {
                    eyeIcon.classList.remove('bi-eye');
                    eyeIcon.classList.add('bi-eye-slash');
                } else {
                    eyeIcon.classList.remove('bi-eye-slash');
                    eyeIcon.classList.add('bi-eye');
                }
            });
        }
    });

    // SweetAlert error messages
    @if($errors->any())
        @if($errors->has('email') && $errors->first('email') === 'These credentials do not match our records.')
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Email atau password tidak sesuai. Silakan coba lagi.',
                confirmButtonColor: '#ef4444'
            });
        @elseif($errors->has('email') && str_contains($errors->first('email'), 'Too many login attempts'))
            Swal.fire({
                icon: 'warning',
                title: 'Terlalu Banyak Percobaan!',
                text: 'Anda telah mencoba login terlalu banyak. Silakan tunggu beberapa menit.',
                confirmButtonColor: '#f59e0b'
            });
        @endif
    @endif
</script>
@endsection
