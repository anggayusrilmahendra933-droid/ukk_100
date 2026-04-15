@extends('layouts.app')

@section('page-title', 'Tambah Buku')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.buku.index') }}" class="btn btn-light rounded-circle p-2 me-3" style="width:40px;height:40px;"><i class="bi bi-arrow-left"></i></a>
                    <h5 class="mb-0 fw-semibold" style="color:#d97706;">Pendaftaran Buku Baru</h5>
                </div>

                <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Judul Buku <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control rounded-3" value="{{ old('title') }}" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium text-muted">Kategori <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select rounded-3" required>
                                        <option value="">Pilih Kategori...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium text-muted">Penulis <span class="text-danger">*</span></label>
                                    <input type="text" name="author" class="form-control rounded-3" value="{{ old('author') }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium text-muted">Penerbit <span class="text-danger">*</span></label>
                                    <input type="text" name="publisher" class="form-control rounded-3" value="{{ old('publisher') }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-medium text-muted">Tahun <span class="text-danger">*</span></label>
                                    <input type="number" name="year" class="form-control rounded-3" value="{{ old('year', date('Y')) }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-medium text-muted">Stok <span class="text-danger">*</span></label>
                                    <input type="number" name="stock" class="form-control rounded-3" value="{{ old('stock', 1) }}" min="0" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Deskripsi Singkat</label>
                                <textarea name="description" class="form-control rounded-3" rows="4">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">No. ISBN</label>
                                <input type="text" name="isbn" class="form-control rounded-3" value="{{ old('isbn') }}" placeholder="Opsional">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium text-muted">Sampul Buku (Cover)</label>
                                <div class="card bg-light border text-center p-3 rounded-4 shadow-sm" style="border-style: dashed !important; border-width: 2px !important;">
                                    <i class="bi bi-image text-muted" style="font-size:2rem;"></i>
                                    <p class="text-muted" style="font-size:12px;">Format: JPG, PNG maksimal 2MB</p>
                                    <input type="file" name="cover_image" class="form-control form-control-sm rounded-3 mt-2" accept="image/*">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-warning w-100 text-white fw-bold rounded-3 py-3 shadow-sm">
                                <i class="bi bi-save me-2"></i> Simpan Buku
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
