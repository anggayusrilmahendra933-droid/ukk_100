<div class="sidebar d-flex flex-column">
    <div class="sidebar-brand">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-book-half fs-4"></i>
            <div>
                <div class="fw-semibold">Perpustakaan</div>
                <div style="font-size:11px; opacity:0.6;">Digital Library</div>
            </div>
        </div>
    </div>

    <nav class="flex-grow-1 mt-3">
        @if(auth()->user()->role === 'admin')
            {{-- Menu Admin --}}
            <div style="font-size:10px; opacity:0.5; padding: 8px 20px; text-transform:uppercase; letter-spacing:1px;">Admin</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <i class="bi bi-tags me-2"></i> Kelola Kategori
            </a>
            <a href="{{ route('admin.buku.index') }}" class="nav-link {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}">
                <i class="bi bi-book me-2"></i> Kelola Buku
            </a>
            <a href="{{ route('admin.anggota.index') }}" class="nav-link {{ request()->routeIs('admin.anggota.*') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Kelola Anggota
            </a>
            <a href="{{ route('admin.peminjaman.index') }}" class="nav-link {{ request()->routeIs('admin.peminjaman.*') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right me-2"></i> Peminjaman
            </a>
            <a href="{{ route('admin.laporan') }}" class="nav-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                <i class="bi bi-bar-chart me-2"></i> Laporan
            </a>
        @else
            {{-- Menu User --}}
            <div style="font-size:10px; opacity:0.5; padding: 8px 20px; text-transform:uppercase; letter-spacing:1px;">Menu</div>
            <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid me-2"></i> Dashboard
            </a>
            <a href="{{ route('user.buku') }}" class="nav-link {{ request()->routeIs('user.buku') ? 'active' : '' }}">
                <i class="bi bi-search me-2"></i> Cari Buku
            </a>
            <a href="{{ route('user.peminjaman') }}" class="nav-link {{ request()->routeIs('user.peminjaman') ? 'active' : '' }}">
                <i class="bi bi-bookmark me-2"></i> Pinjaman Saya
            </a>
            <a href="{{ route('user.riwayat') }}" class="nav-link {{ request()->routeIs('user.riwayat') ? 'active' : '' }}">
                <i class="bi bi-clock-history me-2"></i> Riwayat
            </a>
        @endif
    </nav>

    <div class="p-3" style="border-top: 1px solid rgba(255,255,255,0.1);">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div style="width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,0.2);display:flex;align-items:center;justify-content:center;font-size:13px;">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <div>
                <div style="font-size:13px;font-weight:500;">{{ auth()->user()->name }}</div>
                <div style="font-size:11px;opacity:0.6;">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm w-100" style="background:rgba(255,255,255,0.1);color:white;border:none;">
                <i class="bi bi-box-arrow-right me-1"></i> Keluar
            </button>
        </form>
    </div>
</div>