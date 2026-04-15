@extends('layouts.app')

@section('page-title', 'Kelola Buku')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold" style="color:#d97706;"><i class="bi bi-book me-2"></i>Katalog Buku</h5>
            <a href="{{ route('admin.buku.create') }}" class="btn btn-warning text-white fw-medium rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah Buku
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">Cover</th>
                        <th width="30%">Judul & Penulis</th>
                        <th width="15%">Kategori</th>
                        <th width="15%">Penerbit</th>
                        <th width="10%">Tahun</th>
                        <th width="10%">Stok</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>
                                @if($book->cover_image)
                                    <img src="{{ Storage::url($book->cover_image) }}" alt="Cover" class="img-thumbnail" style="width: 50px; height: 70px; object-fit: cover;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center text-muted border rounded" style="width: 50px; height: 70px; font-size:10px;">
                                        NO IMG
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $book->title }}</div>
                                <div class="text-muted" style="font-size:12px;"><i class="bi bi-person me-1"></i>{{ $book->author }}</div>
                            </td>
                            <td><span class="badge bg-secondary bg-opacity-25 text-dark">{{ $book->category->name ?? '-' }}</span></td>
                            <td class="text-muted" style="font-size:13px;">{{ $book->publisher }}</td>
                            <td>{{ $book->year }}</td>
                            <td>
                                @if($book->stock > 0)
                                    <span class="badge bg-success">{{ $book->stock }}</span>
                                @else
                                    <span class="badge bg-danger">Habis</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.buku.edit', $book->id) }}" class="btn btn-sm btn-outline-primary rounded-2 py-1 px-2 me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.buku.destroy', $book->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus buku ini?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-2 py-1 px-2">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Stok buku kosong. Silahkan tambahkan daftar buku baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
