<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap');

    .sidebar {
        width: 240px;
        min-width: 240px;
        height: 100vh;
        background: #fff;
        border-right: 1px solid #f0f0f2;
        display: flex;
        flex-direction: column;
        position: sticky;
        top: 0;
        box-shadow: 2px 0 12px rgba(0,0,0,0.04);
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 22px 20px 18px;
        border-bottom: 1px solid #f4f4f6;
        text-decoration: none;
    }

    .sidebar-logo img { width: 32px; height: 32px; object-fit: contain; }

    .sidebar-logo-text {
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        letter-spacing: -0.3px;
        line-height: 1.2;
    }

    .sidebar-logo-text span {
        display: block;
        font-size: 10.5px;
        font-weight: 500;
        color: #9ca3af;
        letter-spacing: 0;
    }

    .sidebar-nav { display: flex; flex-direction: column; gap: 2px; padding: 16px 12px; flex: 1; }

    .sidebar-section-label {
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #c4c9d4;
        padding: 12px 10px 6px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 9px 12px;
        border-radius: 9px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        color: #6b7280;
        text-decoration: none;
        transition: background 0.13s, color 0.13s;
    }

    .sidebar-link:hover { background: #f5f5f7; color: #111827; }

    .sidebar-link.active { background: #eff6ff; color: #2563eb; font-weight: 600; }

    .sidebar-link-icon {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        background: #f5f5f7;
        transition: background 0.13s;
    }

    .sidebar-link:hover .sidebar-link-icon { background: #ebebed; }
    .sidebar-link.active .sidebar-link-icon { background: #dbeafe; }

    .sidebar-footer {
        padding: 14px 12px;
        border-top: 1px solid #f4f4f6;
    }

    .sidebar-user {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        background: #fafafa;
    }

    .sidebar-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #6d28d9);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .sidebar-user-name {
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 600;
        color: #111827;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sidebar-user-role {
        font-size: 11px;
        color: #9ca3af;
        font-weight: 400;
    }
</style>

<nav class="sidebar">

    {{-- Logo --}}
    <a href="{{ route('dashboard') }}" class="sidebar-logo">
        <img src="{{ asset('image/logo.png') }}" alt="Logo">
        <div class="sidebar-logo-text">
            Financial Tracker
            <span>Personal Finance</span>
        </div>
    </a>

    {{-- Navigation --}}
    <div class="sidebar-nav">
        <div class="sidebar-section-label">Menu</div>

        <a href="{{ route('dashboard') }}"
           class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="sidebar-link-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="{{ request()->routeIs('dashboard') ? '#2563eb' : '#6b7280' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
            </span>
            Dashboard
        </a>

        <a href="{{ route('records.create') }}"
           class="sidebar-link {{ request()->routeIs('records.create') ? 'active' : '' }}">
            <span class="sidebar-link-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="{{ request()->routeIs('records.create') ? '#2563eb' : '#6b7280' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
                </svg>
            </span>
            Add Transaction
        </a>

        <a href="{{ route('records.index') }}"
           class="sidebar-link {{ request()->routeIs('records.index') ? 'active' : '' }}">
            <span class="sidebar-link-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="{{ request()->routeIs('records.index') ? '#2563eb' : '#6b7280' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="5" width="20" height="14" rx="3"/><path d="M2 10h20"/>
                </svg>
            </span>
            View Records
        </a>

        <a href="{{ route('reports.monthly') }}"
           class="sidebar-link {{ request()->routeIs('reports.monthly') ? 'active' : '' }}">
            <span class="sidebar-link-icon">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="{{ request()->routeIs('reports.monthly') ? '#2563eb' : '#6b7280' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>
                </svg>
            </span>
            Monthly Report
        </a>
    </div>

</nav>