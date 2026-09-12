@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-5">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h4 class="mb-0"><i class="bi bi-box-arrow-in-right me-2"></i>{{ __('Login') }}</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}" id="login-form">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-1"></i>{{ __('Email Address') }}
                            </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan email Anda">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock me-1"></i>{{ __('Password') }}
                            </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="bi bi-box-arrow-in-right me-1"></i>{{ __('Login') }}
                            </button>
                        </div>

                        <div class="text-center">
                            @if (Route::has('password.request'))
                                <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                    <i class="bi bi-question-circle me-1"></i>{{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                        @if (Route::has('register'))
                        <hr class="my-3">
                        <div class="text-center">
                            <small class="text-muted">Belum punya akun?</small>
                            <a href="{{ route('register') }}" class="text-decoration-none">
                                <strong>Daftar Sekarang</strong>
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
    // Show error messages with SweetAlert
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
