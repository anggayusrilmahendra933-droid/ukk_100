@extends('layouts.app')

@section('page-title', 'Tambah Kategori')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-light rounded-circle p-2 me-3" style="width:40px;height:40px;"><i class="bi bi-arrow-left"></i></a>
                    <h5 class="mb-0 fw-semibold" style="color:#d97706;">Tambah Kategori Baru</h5>
                </div>

                <form action="{{ route('admin.kategori.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-medium text-muted">Nama Kategori</label>
                        <input type="text" name="name" class="form-control rounded-3 py-2" value="{{ old('name') }}" placeholder="Misal: Fiksi, Sains, Sejarah..." required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-medium text-muted">Deskripsi Singkat</label>
                        <textarea name="description" class="form-control rounded-3" rows="3" placeholder="Opsional">{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-warning text-white fw-medium rounded-3 px-4 py-2">
                        <i class="bi bi-save me-1"></i> Simpan Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
