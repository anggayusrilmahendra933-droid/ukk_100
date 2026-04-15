@extends('layouts.guest')

@section('title', 'Register - Perpustakaan Digital')

@section('content')
<div class="auth-header">
    <div class="icon"><i class="bi bi-person-plus"></i></div>
    <h5 class="mb-1 fw-semibold">Pendaftaran Anggota</h5>
    <p class="mb-0" style="opacity:0.7;font-size:13px;">Buat akun sebagai siswa</p>
</div>

<div class="auth-body">
    @if($errors->any())
        <div class="alert alert-danger py-2" style="font-size:13px;">
            <ul class="mb-0 ms-2 ps-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <input type="hidden" name="role" value="user">

        <div class="mb-3">
            <label class="form-label fw-medium" style="font-size:13px;">Nama Lengkap</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="name" class="form-control" placeholder="Budi Santoso" value="{{ old('name') }}" required autofocus>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium" style="font-size:13px;">Email</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="siswa@example.com" value="{{ old('email') }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-medium" style="font-size:13px;">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Minimal 4 karakter" required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label fw-medium" style="font-size:13px;">Konfirmasi Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>
        </div>

        <button type="submit" class="btn btn-success w-100 py-2 fw-medium">
            <i class="bi bi-check2-circle me-2"></i>Daftar Sekarang
        </button>
    </form>

    <p class="text-center mt-4 mb-0" style="font-size:13px;color:#6c757d;">
        Sudah memiliki akun?
        <a href="{{ route('login') }}" style="color:#1e3a5f;font-weight:500;text-decoration:none;">Masuk di sini</a>
    </p>
</div>
@endsection