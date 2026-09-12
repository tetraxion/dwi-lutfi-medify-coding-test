@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-success text-white text-center py-3">
                    <h4 class="mb-0"><i class="bi bi-person-plus me-2"></i>{{ __('Register') }}</h4>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}" id="register-form">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-person me-1"></i>{{ __('Name') }}
                            </label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Masukkan nama lengkap">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-1"></i>{{ __('Email Address') }}
                            </label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan email Anda">

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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">
                                <i class="bi bi-lock-fill me-1"></i>{{ __('Confirm Password') }}
                            </label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password">
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success py-2">
                                <i class="bi bi-person-plus me-1"></i>{{ __('Register') }}
                            </button>
                        </div>

                        <hr class="my-3">
                        <div class="text-center">
                            <small class="text-muted">Sudah punya akun?</small>
                            <a href="{{ route('login') }}" class="text-decoration-none">
                                <strong>Login Sekarang</strong>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // Show validation errors with SweetAlert
    @if($errors->any())
        let errorMessages = '';
        @foreach($errors->all() as $error)
            errorMessages += '• {{ $error }}\n';
        @endforeach
        
        Swal.fire({
            icon: 'error',
            title: 'Registrasi Gagal!',
            text: errorMessages,
            confirmButtonColor: '#ef4444'
        });
    @endif
</script>
@endsection
