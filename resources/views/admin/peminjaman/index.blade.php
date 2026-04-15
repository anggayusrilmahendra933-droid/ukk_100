@extends('layouts.app')

@section('page-title', 'Persetujuan Peminjaman')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold" style="color:#d97706;"><i class="bi bi-arrow-left-right me-2"></i>Daftar Peminjaman Aktif</h5>
        </div>
        
        <ul class="nav nav-pills mb-4" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill px-4" id="pills-pending-tab" data-bs-toggle="pill" data-bs-target="#pills-pending" type="button" role="tab">Menunggu Persetujuan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill px-4" id="pills-active-tab" data-bs-toggle="pill" data-bs-target="#pills-active" type="button" role="tab">Sedang Dipinjam</button>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            {{-- TAB PENDING --}}
            <div class="tab-pane fade show active" id="pills-pending" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Siswa</th>
                                <th>Buku Diajukan</th>
                                <th>Stok Buku</th>
                                <th>Tgl Pengajuan</th>
                                <th class="text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $hasPending = false; @endphp
                            @foreach($borrowings as $item)
                                @if($item->status === 'pending')
                                    @php $hasPending = true; @endphp
                                    <tr>
                                        <td>
                                            <div class="fw-medium">{{ $item->user->name }}</div>
                                            <div class="text-muted" style="font-size:12px;">{{ $item->user->email }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-primary">{{ $item->book->title }}</div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $item->book->stock > 0 ? 'bg-info' : 'bg-danger' }}">Tersedia: {{ $item->book->stock }}</span>
                                        </td>
                                        <td class="text-muted" style="font-size:13px;">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                        <td class="text-center">
                                            @if($item->book->stock > 0)
                                                <form action="{{ route('admin.peminjaman.approve', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Setujui pengajuan peminjaman ini?');">
                                                    @csrf
                                                    <button class="btn btn-sm btn-success rounded-2 px-3 me-1">Setujui</button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.peminjaman.reject', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tolak pengajuan peminjaman ini?');">
                                                @csrf
                                                <button class="btn btn-sm btn-danger rounded-2 px-3">Tolak</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            
                            @if(!$hasPending)
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Tidak ada pengajuan buku yang tertunda.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- TAB ACTIVE --}}
            <div class="tab-pane fade" id="pills-active" role="tabpanel">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Siswa</th>
                                <th>Buku Dipinjam</th>
                                <th>Tgl Pinjam</th>
                                <th>Batas Kembali</th>
                                <th class="text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $hasBorrowed = false; @endphp
                            @foreach($borrowings as $item)
                                @if($item->status === 'borrowed')
                                    @php 
                                        $hasBorrowed = true; 
                                        $isPastDue = now()->greaterThan($item->due_date);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="fw-medium">{{ $item->user->name }}</div>
                                        </td>
                                        <td>
                                            <div class="fw-medium text-primary">{{ $item->book->title }}</div>
                                        </td>
                                        <td class="text-muted" style="font-size:13px;">{{ $item->borrow_date->format('d M Y') }}</td>
                                        <td>
                                            <span class="badge {{ $isPastDue ? 'bg-danger' : 'bg-warning text-dark' }}">
                                                {{ $item->due_date->format('d M Y') }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.peminjaman.return', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Konfirmasi bahwa buku telah dikembalikan oleh siswa?');">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-primary rounded-2 px-3">Tandai Dikembalikan</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            
                            @if(!$hasBorrowed)
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada buku yang sedang dipinjam saat ini.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
