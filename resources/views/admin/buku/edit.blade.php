@extends('layouts.app')

@section('page-title', 'Edit Buku')

@section('content')
<div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.buku.index') }}" class="btn btn-light rounded-circle p-2 me-3" style="width:40px;height:40px;"><i class="bi bi-arrow-left"></i></a>
                    <h5 class="mb-0 fw-semibold" style="color:#d97706;">Edit Data Buku</h5>
                </div>

                <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Judul Buku <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control rounded-3" value="{{ old('title', $buku->title) }}" required>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium text-muted">Kategori <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select rounded-3" required>
                                        <option value="">Pilih Kategori...</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $buku->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium text-muted">Penulis <span class="text-danger">*</span></label>
                                    <input type="text" name="author" class="form-control rounded-3" value="{{ old('author', $buku->author) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-medium text-muted">Penerbit <span class="text-danger">*</span></label>
                                    <input type="text" name="publisher" class="form-control rounded-3" value="{{ old('publisher', $buku->publisher) }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-medium text-muted">Tahun <span class="text-danger">*</span></label>
                                    <input type="number" name="year" class="form-control rounded-3" value="{{ old('year', $buku->year) }}" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-medium text-muted">Stok <span class="text-danger">*</span></label>
                                    <input type="number" name="stock" class="form-control rounded-3" value="{{ old('stock', $buku->stock) }}" min="0" required>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">Deskripsi Singkat</label>
                                <textarea name="description" class="form-control rounded-3" rows="4">{{ old('description', $buku->description) }}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-medium text-muted">No. ISBN</label>
                                <input type="text" name="isbn" class="form-control rounded-3" value="{{ old('isbn', $buku->isbn) }}" placeholder="Opsional">
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium text-muted">Sampul Buku Saat Ini</label>
                                <div class="card bg-light border text-center p-3 rounded-4 shadow-sm" style="border-style: dashed !important; border-width: 2px !important;">
                                    @if($buku->cover_image)
                                        <img src="{{ Storage::url($buku->cover_image) }}" alt="Cover" class="img-fluid rounded border mb-2" style="max-height: 150px; object-fit: contain;">
                                    @else
                                        <i class="bi bi-image text-muted" style="font-size:2rem;"></i>
                                        <p class="text-muted" style="font-size:12px;">Belum ada cover</p>
                                    @endif
                                    <p class="text-muted mb-0 mt-2" style="font-size:11px;">Upload baru untuk mengganti gambar</p>
                                    <input type="file" name="cover_image" class="form-control form-control-sm rounded-3 mt-2" accept="image/*">
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-warning w-100 text-white fw-bold rounded-3 py-3 shadow-sm">
                                <i class="bi bi-save me-2"></i> Perbarui Data Buku
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
