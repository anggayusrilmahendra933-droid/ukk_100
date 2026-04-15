@extends('layouts.app')

@section('page-title', 'Laporan Peminjaman')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold" style="color:#d97706;"><i class="bi bi-bar-chart me-2"></i>Rekapitulasi Semua Peminjaman</h5>
            <button class="btn btn-outline-secondary rounded-3 shadow-none" onclick="window.print()">
                <i class="bi bi-printer me-1"></i> Cetak PDF
            </button>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" style="font-size:14px;">
                <thead class="table-light text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Peminjam</th>
                        <th width="25%">Judul Buku</th>
                        <th width="15%">Admin Approval</th>
                        <th width="15%">Batas Kembali</th>
                        <th width="10%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($borrowings as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <div class="fw-medium">{{ $item->user->name }}</div>
                            </td>
                            <td>
                                {{ $item->book->title }}
                            </td>
                            <td class="text-center">
                                {{ $item->borrow_date ? $item->borrow_date->format('d/m/Y') : '-' }}
                            </td>
                            <td class="text-center">
                                {{ $item->due_date ? $item->due_date->format('d/m/Y') : '-' }}
                            </td>
                            <td class="text-center">
                                @if($item->status === 'pending')
                                    <span class="badge bg-warning text-dark"><i class="bi bi-hourglass"></i> Pending</span>
                                @elseif($item->status === 'borrowed')
                                    <span class="badge bg-primary"><i class="bi bi-arrow-right-circle"></i> Dipinjam</span>
                                @elseif($item->status === 'returned')
                                    <span class="badge bg-success"><i class="bi bi-check-circle"></i> Selesai</span>
                                @elseif($item->status === 'rejected')
                                    <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada rekam jejak peminjaman sistem.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-print-block d-none mt-5">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4 text-center">
                        <p>Mengetahui,</p>
                        <br><br><br>
                        <p><strong>Administrator Perpustakaan</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .card, .card * {
            visibility: visible;
        }
        .card {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none !important;
            box-shadow: none !important;
        }
        .btn, .sidebar, .topbar { display: none !important; }
        .d-print-block { display: block !important; }
    }
</style>
@endpush
@endsection
