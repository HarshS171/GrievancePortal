<nav class="navbar">
    <div class="container nav-inner">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="nav-logo">
                <div class="nav-logo-icon">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                GrievancePortal
            </a>

            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>

            @if(auth()->user()->role === 'citizen')
                <a href="{{ route('complaints.index') }}" class="nav-link {{ request()->routeIs('complaints.*') ? 'active' : '' }}">My Complaints</a>
            @endif

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.complaints') }}" class="nav-link {{ request()->routeIs('admin.complaints*') ? 'active' : '' }}">Manage Complaints</a>
            @endif
        </div>

        <div class="nav-right">
            <a href="{{ route('profile.edit') }}" class="nav-user">
                <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                {{ Auth::user()->name }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm">Log out</button>
            </form>
        </div>
    </div>
</nav>
