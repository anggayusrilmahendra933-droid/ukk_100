<div class="topbar">
    <div class="d-flex align-items-center gap-3">
        <h6 class="mb-0 fw-semibold text-dark">@yield('page-title', 'Dashboard')</h6>
    </div>
    <div class="d-flex align-items-center gap-3">
        <span class="badge" style="background:#e8f0fe;color:#1e3a5f;font-size:12px;padding:6px 12px;">
            {{ ucfirst(auth()->user()->role) }}
        </span>
        <span class="text-muted" style="font-size:13px;">{{ auth()->user()->name }}</span>
    </div>
</div>