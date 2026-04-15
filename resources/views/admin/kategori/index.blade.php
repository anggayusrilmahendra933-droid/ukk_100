@extends('layouts.app')

@section('page-title', 'Kelola Kategori')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold" style="color:#d97706;"><i class="bi bi-tags me-2"></i>Daftar Kategori</h5>
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-warning text-white fw-medium rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Tambah Baru
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Nama Kategori</th>
                        <th width="50%">Deskripsi</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-medium">{{ $item->name }}</td>
                            <td>{{ $item->description ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.kategori.edit', $item->id) }}" class="btn btn-sm btn-outline-primary rounded-2 shadow-none me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-2 shadow-none">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada kategori terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
