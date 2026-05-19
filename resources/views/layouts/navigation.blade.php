<nav x-data="{ mobileOpen: false }" class="glass-header">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 lg:h-[4.25rem]">
            <div class="flex items-center gap-8">
                <x-portal-logo size="md" :href="route('dashboard')" />

                <div class="hidden lg:flex items-center gap-1">
                    @php
                        $navLink = fn($active) => $active
                            ? 'inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-sm font-semibold text-portal-900 bg-portal-50 border border-portal-100 transition-all'
                            : 'inline-flex items-center gap-2 px-3.5 py-2 rounded-xl text-sm font-semibold text-slate-600 hover:text-portal-900 hover:bg-slate-50 border border-transparent transition-all';
                    @endphp

                    <a href="{{ route('dashboard') }}" class="{{ $navLink(request()->routeIs('dashboard') || request()->routeIs('admin.dashboard')) }}">
                        <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>

                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('complaints.index') }}" class="{{ $navLink(request()->routeIs('complaints.*') && !request()->routeIs('complaints.create')) }}">
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            My Complaints
                        </a>
                        <a href="{{ route('complaints.create') }}" class="{{ $navLink(request()->routeIs('complaints.create')) }}">
                            <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            File Grievance
                        </a>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.complaints') }}" class="{{ $navLink(request()->routeIs('admin.complaints*')) }}">
                            Manage
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="{{ $navLink(request()->routeIs('admin.categories*')) }}">
                            Categories
                        </a>
                        <a href="{{ route('admin.analytics') }}" class="{{ $navLink(request()->routeIs('admin.analytics')) }}">
                            Analytics
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden lg:flex items-center gap-3">
                @if(auth()->user()->role === 'admin')
                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-extrabold uppercase tracking-wider bg-portal-900 text-white">Admin</span>
                @endif
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-xl hover:bg-slate-50 border border-transparent hover:border-slate-200 transition-all">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-portal-700 to-portal-900 text-white font-bold flex items-center justify-center text-sm shadow-md shadow-portal-900/20">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-semibold text-slate-700 max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost text-sm py-2 px-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Log out
                    </button>
                </form>
            </div>

            <div class="flex items-center lg:hidden">
                <button type="button" @click="mobileOpen = !mobileOpen" class="inline-flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 hover:bg-slate-100 border border-slate-200 transition-colors" aria-label="Toggle menu">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="mobileOpen" x-cloak x-transition class="lg:hidden border-t border-slate-200 bg-white/95 backdrop-blur-xl">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-portal-50 text-portal-900' : 'text-slate-700 hover:bg-slate-50' }}">Dashboard</a>
            @if(auth()->user()->role === 'user')
                <a href="{{ route('complaints.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('complaints.index') || request()->routeIs('complaints.show') ? 'bg-portal-50 text-portal-900' : 'text-slate-700 hover:bg-slate-50' }}">My Complaints</a>
                <a href="{{ route('complaints.create') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('complaints.create') ? 'bg-portal-50 text-portal-900' : 'text-slate-700 hover:bg-slate-50' }}">File Grievance</a>
            @endif
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.complaints') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.complaints*') ? 'bg-portal-50 text-portal-900' : 'text-slate-700 hover:bg-slate-50' }}">Manage Complaints</a>
                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.categories*') ? 'bg-portal-50 text-portal-900' : 'text-slate-700 hover:bg-slate-50' }}">Categories</a>
                <a href="{{ route('admin.analytics') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('admin.analytics') ? 'bg-portal-50 text-portal-900' : 'text-slate-700 hover:bg-slate-50' }}">Analytics</a>
            @endif
            <div class="pt-4 mt-4 border-t border-slate-100 space-y-2">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-slate-50">
                    <div class="w-9 h-9 rounded-xl bg-portal-900 text-white font-bold flex items-center justify-center text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <span class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 rounded-xl text-sm font-semibold text-rose-600 hover:bg-rose-50">Log out</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>[x-cloak] { display: none !important; }</style>
