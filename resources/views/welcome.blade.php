@extends('layouts.app')

@section('page-title', 'Selamat Datang')

@push('styles')
<style>
    /* Hero Section Stylings */
    .hero-section {
        background: linear-gradient(135deg, #1e3a5f 0%, #152744 100%);
        position: relative;
        overflow: hidden;
        border-radius: 1.5rem;
        padding: 5rem 2rem;
        box-shadow: 0 20px 40px rgba(30, 58, 95, 0.15);
    }
    .hero-pattern {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-image: radial-gradient(rgba(255,255,255,0.1) 2px, transparent 2px);
        background-size: 30px 30px;
        opacity: 0.3;
        z-index: 1;
    }
    .hero-content {
        position: relative;
        z-index: 2;
    }
    .hero-title {
        font-weight: 800;
        letter-spacing: -1px;
        line-height: 1.2;
    }
    .hero-badge {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #e0e7ff;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        display: inline-block;
        margin-bottom: 1.5rem;
        font-weight: 500;
        letter-spacing: 0.5px;
    }
    
    /* Feature Cards */
    .feature-card {
        background: #ffffff;
        border-radius: 1rem;
        padding: 2.5rem 1.5rem;
        height: 100%;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(30, 58, 95, 0.1);
        border-color: rgba(30, 58, 95, 0.1);
    }
    .feature-icon-wrapper {
        width: 64px;
        height: 64px;
        border-radius: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }
    .feature-card:hover .feature-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
    }
    .icon-blue { background: #e8f0fe; color: #1e3a5f; }
    .icon-orange { background: #fff3e0; color: #d97706; }
    .icon-green { background: #e8f7ee; color: #198754; }

    /* CTA Section */
    .cta-wrapper {
        background: url('data:image/svg+xml;utf8,<svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="2" fill="%231e3a5f" fill-opacity="0.05"/></pattern></defs><rect width="100%" height="100%" fill="url(%23dots)"/></svg>');
        background-color: #f8f9fa;
        border-radius: 1.5rem;
        padding: 4rem 2rem;
        border: 1px solid rgba(0,0,0,0.05);
    }
</style>
@endpush

@section('content')

<!-- HERO SECTION -->
<div class="row justify-content-center mb-5 mt-2">
    <div class="col-xl-11">
        <div class="hero-section text-white text-center">
            <div class="hero-pattern"></div>
            <div class="hero-content">
                <div class="hero-badge shadow-sm">
                    <i class="bi bi-stars me-1 text-warning"></i> Era Baru Perpustakaan
                </div>
                <h1 class="hero-title display-4 mb-4">
                    Eksplorasi Jendela Dunia <br class="d-none d-md-block"> 
                    <span style="color: #fbbf24;">Lebih Mudah & Modern</span>
                </h1>
                <p class="lead mb-5 mx-auto" style="max-width: 650px; opacity: 0.9; font-size: 1.1rem; line-height: 1.6;">
                    Sistem perpustakaan digital interaktif yang dirancang khusus untuk mempermudah ekosistem guru, admin, dan minat baca siswa-siswi.
                </p>

                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-warning text-dark fw-bold px-5 py-3 rounded-pill shadow-lg transition" style="font-size: 1.05rem;">
                            Bergabung Sebagai Siswa
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-light fw-medium px-4 py-3 rounded-pill" style="border-width: 2px;">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </a>
                    @endguest

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning text-dark fw-bold px-5 py-3 rounded-pill shadow-lg">
                                Buka Ruang Kerja Admin <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="btn btn-warning text-dark fw-bold px-5 py-3 rounded-pill shadow-lg">
                                Lanjut Membaca, {{ explode(' ', auth()->user()->name)[0] }}! <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURES SECTION -->
<div class="row justify-content-center mt-5 mb-5 px-xl-4 pb-4">
    <div class="col-12 text-center mb-5">
        <h6 class="text-uppercase fw-bold" style="color: #d97706; letter-spacing: 1px; font-size: 0.85rem;">Keunggulan Sistem</h6>
        <h2 class="fw-bold text-dark mb-3">Kenapa Menggunakan Digital Library?</h2>
        <div style="width: 60px; height: 4px; background: #1e3a5f; margin: 0 auto; border-radius: 2px;"></div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card">
            <div class="feature-icon-wrapper icon-blue mx-auto mx-md-0">
                <i class="bi bi-grid-1x2-fill"></i>
            </div>
            <h4 class="fw-bold mb-3 text-center text-md-start" style="color: #1e3a5f;">Katalog Modern</h4>
            <p class="text-muted mb-0 text-center text-md-start lh-lg" style="font-size: 0.95rem;">
                Tampilan antarmuka yang bersih dan estetis memudahkan Anda menemukan buku bacaan yang tepat. Cari berdasar kategori, judul, atau penulis secara instan.
            </p>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card">
            <div class="feature-icon-wrapper icon-orange mx-auto mx-md-0">
                <i class="bi bi-cursor-fill"></i>
            </div>
            <h4 class="fw-bold mb-3 text-center text-md-start" style="color: #1e3a5f;">Peminjaman Instan</h4>
            <p class="text-muted mb-0 text-center text-md-start lh-lg" style="font-size: 0.95rem;">
                Tak perlu repot antre panjang. Anda dapat mengajukan peminjaman buku dari mana saja, dan ambil bukunya di perpustakaan jika disetujui staf.
            </p>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <div class="feature-card">
            <div class="feature-icon-wrapper icon-green mx-auto mx-md-0">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <h4 class="fw-bold mb-3 text-center text-md-start" style="color: #1e3a5f;">Histori Presisi</h4>
            <p class="text-muted mb-0 text-center text-md-start lh-lg" style="font-size: 0.95rem;">
                Algoritma kami mencatat setiap rekam jejak literasi Anda. Dapatkan peringatan otomatis apabila tanggal pengembalian buku sudah hampir jatuh tempo.
            </p>
        </div>
    </div>
</div>

@guest
<!-- CTA SECTION -->
<div class="row justify-content-center mb-5 pb-4">
    <div class="col-xl-10">
        <div class="cta-wrapper shadow-sm text-center">
            <h3 class="fw-bold text-dark mb-3">Siap Memperkaya Wawasan Anda?</h3>
            <p class="text-muted mb-4 mx-auto" style="max-width: 600px; font-size: 1.05rem;">
                Bergabunglah bersama ratusan siswa lainnya dalam ekosistem digitalisasi ini dan temukan hobi membacamu dengan gaya baru.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary fw-medium px-5 py-3 rounded-pill shadow" style="background:#1e3a5f; border-color:#1e3a5f;">
                Buka Akun Sekarang <i class="bi bi-box-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</div>
@endguest

@endsection