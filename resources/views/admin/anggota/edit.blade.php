@extends('layouts.app')

@section('page-title', 'Edit Anggota')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4">
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-light rounded-circle p-2 me-3" style="width:40px;height:40px;"><i class="bi bi-arrow-left"></i></a>
                    <h5 class="mb-0 fw-semibold" style="color:#d97706;">Edit Data Anggota</h5>
                </div>

                <form action="{{ route('admin.anggota.update', $member->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-medium text-muted">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-3 py-2" value="{{ old('name', $member->name) }}" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-medium text-muted">Alamat Email</label>
                        <input type="email" name="email" class="form-control rounded-3 py-2" value="{{ old('email', $member->email) }}" required>
                    </div>

                    <p class="text-muted" style="font-size:12px;"><i class="bi bi-info-circle me-1"></i>Password tidak dapat diubah oleh admin. Anggota harus merubahnya sendiri secara mandiri atau admin menghapus akunnya.</p>

                    <button type="submit" class="btn btn-warning text-white fw-medium rounded-3 px-4 py-2">
                        <i class="bi bi-save me-1"></i> Perbarui Data Anggota
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
