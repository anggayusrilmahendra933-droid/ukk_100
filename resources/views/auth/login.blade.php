@extends('layouts.guest')

@section('title', 'Login - Perpustakaan Digital')

@section('content')
<div class="auth-header">
    <div class="icon"><i class="bi bi-book-half"></i></div>
    <h5 class="mb-1 fw-semibold">Perpustakaan Digital</h5>
    <p class="mb-0" style="opacity:0.7;font-size:13px;">Masuk ke akun Anda</p>
</div>

<div class="auth-body">
    {{-- Tab Role --}}
    <ul class="nav nav-pills role-tabs mb-4 p-1" style="background:#f1f3f5;border-radius:10px;" id="roleTab">
        <li class="nav-item flex-fill text-center">
            <a class="nav-link active w-100" id="user-tab" href="#" onclick="setRole('user')">
                <i class="bi bi-person me-1"></i> User
            </a>
        </li>
        <li class="nav-item flex-fill text-center">
            <a class="nav-link w-100" id="admin-tab" href="#" onclick="setRole('admin')">
                <i class="bi bi-shield-check me-1"></i> Admin
            </a>
        </li>
    </ul>

    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:13px;">
            <i class="bi bi-exclamation-circle me-1"></i>
            {{ $errors->first() }}
        </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success py-2" style="font-size:13px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <input type="hidden" name="role" id="roleInput" value="user">

        <div class="mb-3">
            <label class="form-label fw-medium" style="font-size:13px;">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="email@example.com" value="{{ old('email') }}" required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium" style="font-size:13px;">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="••••••••" required>
                <button class="btn btn-outline-secondary" type="button" onclick="togglePass()">
                    <i class="bi bi-eye" id="eyeIcon"></i>
                </button>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                <label class="form-check-label" for="remember" style="font-size:13px;">Ingat saya</label>
            </div>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="font-size:13px;color:#1e3a5f;text-decoration:none;">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-primary w-100 py-2 fw-medium">
            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
        </button>
    </form>

    @if(Route::has('register'))
        <p class="text-center mt-4 mb-0" style="font-size:13px;color:#6c757d;">
            Belum punya akun?
            <a href="{{ route('register') }}" style="color:#1e3a5f;font-weight:500;text-decoration:none;">Daftar sekarang</a>
        </p>
    @endif
</div>

@push('scripts')
<script>
function setRole(role) {
    document.getElementById('roleInput').value = role;
    document.getElementById('user-tab').classList.toggle('active', role === 'user');
    document.getElementById('admin-tab').classList.toggle('active', role === 'admin');
}
function togglePass() {
    const input = document.querySelector('input[name="password"]');
    const icon = document.getElementById('eyeIcon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
@endpush
@endsection