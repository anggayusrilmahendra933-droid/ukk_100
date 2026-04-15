@extends('layouts.app')

@section('page-title', 'Riwayat Peminjaman')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold" style="color:#d97706;"><i class="bi bi-clock-history me-2"></i>Histori Peminjaman</h5>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="35%">Judul Buku</th>
                        <th width="15%">Tgl Peminjaman</th>
                        <th width="15%">Batas Kembali</th>
                        <th width="15%">Tgl Dikembalikan</th>
                        <th width="20%" class="text-center">Status Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($history as $item)
                        <tr>
                            <td>
                                <div class="fw-medium text-dark">{{ $item->book->title }}</div>
                                <div class="text-muted" style="font-size:12px;">Penerbit: {{ $item->book->publisher }}</div>
                            </td>
                            <td class="text-muted" style="font-size:13px;">{{ $item->borrow_date ? $item->borrow_date->format('d M Y') : '-' }}</td>
                            <td class="text-muted" style="font-size:13px;">{{ $item->due_date ? $item->due_date->format('d M Y') : '-' }}</td>
                            <td class="text-muted" style="font-size:13px;">{{ $item->return_date ? $item->return_date->format('d M Y') : '-' }}</td>
                            <td class="text-center">
                                @if($item->status === 'returned')
                                    <span class="badge bg-success bg-opacity-75"><i class="bi bi-check-circle me-1"></i> Tuntas (Dikembalikan)</span>
                                @elseif($item->status === 'rejected')
                                    <span class="badge bg-danger bg-opacity-75"><i class="bi bi-x-circle me-1"></i> Ditolak Admin</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada catatan histori pengembalian atau penolakan buku.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
