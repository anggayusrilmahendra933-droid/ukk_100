@extends('layouts.app')

@section('page-title', 'Katalog Buku')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div>
        <h5 class="mb-1 fw-semibold" style="color:#1e3a5f;">Koleksi Buku</h5>
        <p class="mb-0 text-muted" style="font-size:13px;">Temukan dan pinjam koleksi buku perpustakaan digital kami.</p>
    </div>
    
    <form action="{{ route('user.buku') }}" method="GET" class="d-flex" style="max-width: 400px; width: 100%;">
        <div class="input-group shadow-sm">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Cari judul buku atau penulis..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-warning text-white fw-medium px-4">Cari</button>
        </div>
    </form>
</div>

<div class="row g-4">
    @forelse($books as $book)
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden book-card transition-all">
                <div class="position-relative bg-light text-center" style="height: 250px;">
                    @if($book->cover_image)
                        <img src="{{ Storage::url($book->cover_image) }}" class="w-100 h-100" style="object-fit: cover;" alt="Cover Buku">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                            <i class="bi bi-book text-opacity-25" style="font-size: 5rem;"></i>
                        </div>
                    @endif
                    
                    <div class="position-absolute top-0 end-0 p-2">
                        @if($book->stock > 0)
                            <span class="badge bg-success shadow-sm">Tersedia {{ $book->stock }}</span>
                        @else
                            <span class="badge bg-danger shadow-sm">Habis Dipinjam</span>
                        @endif
                    </div>
                </div>
                
                <div class="card-body d-flex flex-column p-4">
                    <span class="badge bg-primary bg-opacity-10 text-primary mb-2 align-self-start" style="font-size:11px;">
                        {{ $book->category->name ?? 'Umum' }}
                    </span>
                    <h6 class="card-title fw-bold mb-1" style="font-size:16px;">{{ $book->title }}</h6>
                    <p class="card-text text-muted mb-3" style="font-size:12px;">
                        <i class="bi bi-person me-1"></i> {{ $book->author }}
                        <br>
                        <i class="bi bi-building me-1 mt-1 d-inline-block"></i> {{ $book->publisher }} ({{ $book->year }})
                    </p>
                    
                    <div class="mt-auto pt-3 border-top">
                        @if($book->stock > 0)
                            <form action="{{ route('user.buku.pinjam', $book->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengajukan peminjaman buku ini?');">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning w-100 fw-medium rounded-pill border-2">
                                    <i class="bi bi-journal-plus me-1"></i> Ajukan Pinjaman
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary w-100 fw-medium rounded-pill" disabled>
                                <i class="bi bi-dash-circle me-1"></i> Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 py-5 text-center">
            <div class="card border-0 shadow-sm rounded-4 p-5">
                <i class="bi bi-emoji-frown text-muted" style="font-size: 3rem;"></i>
                <h5 class="mt-3 text-muted">Tidak ada buku ditemukan.</h5>
                <p class="text-muted" style="font-size:14px;">Maaf, kata kunci atau koleksi buku saat ini sedang kosong.</p>
                @if(request('search'))
                    <a href="{{ route('user.buku') }}" class="btn btn-outline-primary mt-2">Reset Pencarian</a>
                @endif
            </div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-4 pt-3">
    {{ $books->links() }}
</div>

@push('styles')
<style>
    .book-card:hover { transform: translateY(-5px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important; }
    .transition-all { transition: all .3s ease; }
</style>
@endpush
@endsection
