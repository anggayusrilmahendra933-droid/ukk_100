@extends('layouts.app')

@section('page-title', 'Kelola Anggota')

@section('content')
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0 fw-semibold" style="color:#d97706;"><i class="bi bi-people me-2"></i>Daftar Anggota / Siswa</h5>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Lengkap</th>
                        <th width="30%">Email</th>
                        <th width="20%">Tgl Bergabung</th>
                        <th width="20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-medium">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:32px;height:32px;border-radius:50%;background:#e8f0fe;color:#1e3a5f;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:bold;">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </div>
                                    {{ $member->name }}
                                </div>
                            </td>
                            <td>{{ $member->email }}</td>
                            <td class="text-muted" style="font-size:13px;">{{ $member->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.anggota.edit', $member->id) }}" class="btn btn-sm btn-outline-primary rounded-2 py-1 px-2 me-1">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.anggota.destroy', $member->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Keluarkan anggota ini secara permanen?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-2 py-1 px-2">
                                        <i class="bi bi-person-dash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada anggota yang mendaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
