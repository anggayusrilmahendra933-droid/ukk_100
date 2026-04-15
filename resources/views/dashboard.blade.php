@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h5 class="fw-semibold">Selamat datang, {{ auth()->user()->Angga yusril mahend}}!</h5>
    <p class="text-muted mb-0" style="font-size:14px;">Temukan dan pinjam buku favoritmu di sini.</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:44px;height:44px;border-radius:10px;background:#e8f0fe;display:flex;align-items:center;justify-content:center;font-size:20px;">📖</div>
                <div>
                    <div style="font-size:12px;color:#6c757d;">Sedang Dipinjam</div>
                    <div style="font-size:22px;font-weight:600;color:#1e3a5f;">{{ $sedangDipinjam ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:44px;height:44px;border-radius:10px;background:#e8f7ee;display:flex;align-items:center;justify-content:center;font-size:20px;">✅</div>
                <div>
                    <div style="font-size:12px;color:#6c757d;">Total Dikembalikan</div>
                    <div style="font-size:22px;font-weight:600;color:#1e3a5f;">{{ $totalKembali ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div style="width:44px;height:44px;border-radius:10px;background:#fce8e8;display:flex;align-items:center;justify-content:center;font-size:20px;">⚠️</div>
                <div>
                    <div style="font-size:12px;color:#6c757d;">Terlambat</div>
                    <div style="font-size:22px;font-weight:600;color:#dc3545;">{{ $terlambat ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Pinjaman Aktif --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold">Pinjaman Aktif Saya</h6>
        <a href="{{ route('user.peminjaman') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background:#f8f9fa;font-size:13px;">
                    <tr>
                        <th class="px-4 py-3">Judul Buku</th>
                        <th class="py-3">Tgl Pinjam</th>
                        <th class="py-3">Tgl Kembali</th>
                        <th class="py-3">Status</th>
                    </tr>
                </thead>
                <tbody style="font-size:13px;">
                    @forelse($pinjamanAktif ?? [] as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $item->buku->judul }}</td>
                        <td class="py-3">{{ $item->tgl_pinjam->format('d M Y') }}</td>
                        <td class="py-3">{{ $item->tgl_kembali->format('d M Y') }}</td>
                        <td class="py-3">
                            @if(now()->gt($item->tgl_kembali))
                                <span class="badge bg-danger">Terlambat</span>
                            @else
                                <span class="badge bg-warning text-dark">Dipinjam</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">Tidak ada pinjaman aktif</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection