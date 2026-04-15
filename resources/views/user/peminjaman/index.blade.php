@extends('layouts.app')

@section('page-title', 'Peminjaman Saya')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0 fw-semibold" style="color:#d97706;"><i class="bi bi-bookmark-star me-2"></i>Status Peminjaman Anda</h5>
                    <a href="{{ route('user.buku') }}" class="btn btn-outline-warning rounded-pill px-4">Pinjam Buku Lain</a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Tgl Meminjam</th>
                                <th>Batas Kembali (Due Date)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($borrowings as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            @if($item->book->cover_image)
                                                <img src="{{ Storage::url($item->book->book->cover_image ?? '') }}" alt="Cover" width="40" class="rounded shadow-sm">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="width: 40px; height: 50px;">
                                                    <i class="bi bi-journal text-muted"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="fw-semibold text-dark">{{ $item->book->title }}</div>
                                                <div class="text-muted" style="font-size:12px;">{{ $item->book->author }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($item->status === 'pending')
                                            <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split me-1"></i> Menunggu Persetujuan</span>
                                        @elseif($item->status === 'borrowed')
                                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Sedang Dipinjam</span>
                                        @endif
                                    </td>
                                    <td class="text-muted" style="font-size:13px;">
                                        {{ $item->borrow_date ? $item->borrow_date->format('d M Y') : '-' }}
                                    </td>
                                    <td>
                                        @if($item->status === 'borrowed' && $item->due_date)
                                            @php
                                                $isNear = now()->diffInDays($item->due_date, false) <= 3;
                                                $isPast = now()->greaterThan($item->due_date);
                                            @endphp
                                            <span class="badge {{ $isPast ? 'bg-danger' : ($isNear ? 'bg-warning text-dark' : 'bg-info text-dark') }} fs-6">
                                                {{ $item->due_date->format('d M Y') }}
                                            </span>
                                            @if($isPast)
                                                <div class="text-danger mt-1" style="font-size:11px;"><i class="bi bi-exclamation-triangle"></i> Terlambat! Segera kembalikan ke perpustakaan.</div>
                                            @endif
                                        @else
                                            <span class="text-muted" style="font-size:13px;">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="text-muted mb-3"><i class="bi bi-journal-x" style="font-size: 3rem;"></i></div>
                                        <h6 class="text-secondary fw-semibold">Tidak Ada Peminjaman Aktif.</h6>
                                        <p class="text-muted mb-0" style="font-size:14px;">Buku yang sedang Anda ajukan atau pinjam akan muncul di sini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
