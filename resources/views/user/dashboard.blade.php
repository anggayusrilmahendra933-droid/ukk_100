@extends('layouts.app')

@section('page-title', 'Dashboard Siswa')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold" style="color:#1e3a5f;">Halo, {{ auth()->user()->name }}</h4>
    <p class="text-muted">Selamat datang kembali di area keanggotaan Perpustakaan Digital.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div style="width:50px;height:50px;border-radius:12px;background:#e8f0fe;color:#1e3a5f;display:flex;align-items:center;justify-content:center;font-size:20px;">
                    <i class="bi bi-journal-text"></i>
                </div>
                <div>
                    <div style="font-size:13px;color:#6c757d;font-weight:500;">Buku Sedang Dipinjam</div>
                    <div style="font-size:24px;font-weight:700;color:#1e3a5f;">{{ $stats['sedang_dipinjam'] }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div style="width:50px;height:50px;border-radius:12px;background:#e8f7ee;color:#198754;display:flex;align-items:center;justify-content:center;font-size:20px;">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div>
                    <div style="font-size:13px;color:#6c757d;font-weight:500;">Buku Telah Dikembalikan</div>
                    <div style="font-size:24px;font-weight:700;color:#198754;">{{ $stats['total_selesai'] }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 rounded-4 {{ $stats['terlambat'] > 0 ? 'border border-danger' : '' }}">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div style="width:50px;height:50px;border-radius:12px;background:#fce8e8;color:#dc3545;display:flex;align-items:center;justify-content:center;font-size:20px;">
                    <i class="bi bi-exclamation-triangle"></i>
                </div>
                <div>
                    <div style="font-size:13px;color:#dc3545;font-weight:600;">Status Terlambat</div>
                    <div style="font-size:24px;font-weight:700;color:#dc3545;">{{ $stats['terlambat'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-clock-history me-2"></i>Status Peminjaman Aktif Anda</h6>
                <a href="{{ route('user.peminjaman') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Detail</a>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <tbody>
                            @forelse($pinjamanAktif as $item)
                                <tr class="border-bottom">
                                    <td class="ps-0 py-3">
                                        <div class="fw-semibold text-dark">{{ $item->book->title }}</div>
                                        <div class="text-muted" style="font-size:12px;">{{ $item->book->author }}</div>
                                    </td>
                                    <td class="py-3">
                                        @if($item->status === 'pending')
                                            <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Pending Approval</span>
                                        @elseif($item->status === 'borrowed')
                                            @php
                                                $isPast = now()->greaterThan($item->due_date);
                                            @endphp
                                            <span class="badge {{ $isPast ? 'bg-danger' : 'bg-success' }}">
                                                {{ $isPast ? 'Terlambat! Batas: ' : 'Jatuh Tempo: ' }} {{ $item->due_date->format('d/m/Y') }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center py-5">
                                        <div class="text-muted mb-2"><i class="bi bi-bookmark-check" style="font-size:2rem;"></i></div>
                                        <div class="text-muted" style="font-size:14px;">Tidak ada pinjaman buku yang aktif saat ini.</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mt-4 mt-lg-0">
        <div class="card border-0 shadow-sm rounded-4 h-100 bg-primary bg-opacity-10" style="border: 1px solid rgba(13, 110, 253, 0.1) !important;">
            <div class="card-body p-4 d-flex flex-column justify-content-center align-items-center text-center">
                <div class="mb-3">
                    <i class="bi bi-search" style="font-size:3rem;color:#1e3a5f;"></i>
                </div>
                <h5 class="fw-bold mb-2" style="color:#1e3a5f;">Ingin Membaca Sesuatu?</h5>
                <p class="text-muted mb-4" style="font-size:14px;">Eksplorasi ribuan koleksi buku digital dan cetak yang tersedia di server perpustakaan kami.</p>
                <a href="{{ route('user.buku') }}" class="btn btn-primary rounded-pill px-4 py-2 fw-medium w-100 shadow-sm">
                    Mulai Cari Buku <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
