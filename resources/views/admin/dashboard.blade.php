@extends('layouts.app')

@section('page-title', 'Dashboard Admin')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;border-radius:14px;background:#e8f0fe;color:#1e3a5f;display:flex;align-items:center;justify-content:center;font-size:24px;">
                    <i class="bi bi-book"></i>
                </div>
                <div>
                    <div style="font-size:13px;color:#6c757d;font-weight:500;">Total Koleksi Buku</div>
                    <div style="font-size:28px;font-weight:700;color:#1e3a5f;">{{ $stats['total_buku'] }} <span style="font-size:14px;color:#6c757d;font-weight:normal;">/ {{ $stats['judul_buku'] }} Judul</span></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 rounded-4">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div style="width:56px;height:56px;border-radius:14px;background:#e8f7ee;color:#198754;display:flex;align-items:center;justify-content:center;font-size:24px;">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <div style="font-size:13px;color:#6c757d;font-weight:500;">Total Anggota Aktif</div>
                    <div style="font-size:28px;font-weight:700;color:#1e3a5f;">{{ $stats['total_anggota'] }}</div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xl-4">
        <div class="card border-0 shadow-sm h-100 rounded-4" style="background:#fffaf0;">
            <div class="card-body p-4 d-flex px-4 align-items-center gap-3">
                <div style="width:56px;height:56px;border-radius:14px;background:#fce8e8;color:#dc3545;display:flex;align-items:center;justify-content:center;font-size:24px;">
                    <i class="bi bi-bell-fill"></i>
                </div>
                <div>
                    <div style="font-size:13px;color:#d97706;font-weight:600;">Menunggu Persetujuan</div>
                    <div style="font-size:28px;font-weight:700;color:#dc3545;">{{ $stats['menunggu_persetujuan'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold" style="color:#d97706;"><i class="bi bi-clock-history me-2"></i>Pengajuan Terbaru (Menunggu Approval)</h6>
        <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">Buka Menu Peminjaman</a>
    </div>
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="30%">Nama Anggota</th>
                        <th width="40%">Buku yang Diajukan</th>
                        <th width="15%">Tanggal Pengajuan</th>
                        <th width="15%" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingBorrowings as $item)
                        <tr>
                            <td class="fw-medium text-dark">{{ $item->user->name }}</td>
                            <td><span class="text-primary fw-medium">{{ $item->book->title }}</span></td>
                            <td class="text-muted" style="font-size:13px;">{{ $item->created_at->diffForHumans() }}</td>
                            <td class="text-center">
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><i class="bi bi-hourglass-split me-1"></i> Pending</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada pengajuan peminjaman baru hari ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection