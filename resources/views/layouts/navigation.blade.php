<nav x-data="{ mobileOpen: false }" class="relative z-10">
    <div class="lg:flex lg:min-h-screen">
        <aside class="hidden lg:fixed lg:top-0 lg:left-0 lg:flex lg:w-80 lg:flex-col lg:justify-between lg:h-screen lg:overflow-y-auto" style="background:rgba(11,21,37,0.95); border-right:1px solid rgba(255,255,255,0.08); color:var(--text-primary, #e8f4ff);">
            <div class="px-6 py-8">
                <div class="flex items-center gap-3">
                    <div style="width:36px;height:36px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:rgba(59,130,246,0.25);border:1px solid rgba(59,130,246,0.4);">
                        <x-portal-logo size="sm" :show-text="false" :href="route('dashboard')" class="text-white" />
                    </div>
                    <div>
                        <p style="font-size:16px;font-weight:700;color:#e8f4ff;line-height:1;">GrievancePortal</p>
                        <span style="font-size:10px;letter-spacing:0.12em;display:block;color:rgba(255,255,255,0.4);">CITIZEN REDRESSAL</span>
                    </div>
                </div>

                @php
                    $navLink = fn($active) => $active
                        ? 'block rounded-2xl px-4 py-3 text-sm font-semibold text-sky-200 bg-sky-500/10 border border-sky-500/20 transition-all'
                        : 'block rounded-2xl px-4 py-3 text-sm font-semibold text-slate-300 hover:text-white hover:bg-white/5 transition-all';
                @endphp

                <div class="mt-10 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block text-sm rounded-2xl" style="display:block;color:rgba(255,255,255,0.55);font-size:14px;padding:6px 14px;border-radius:8px;{{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3);color:#93c5fd;' : '' }} transition:all;">
                        Dashboard
                    </a>
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('complaints.index') }}" class="block text-sm rounded-2xl" style="display:block;color:rgba(255,255,255,0.55);font-size:14px;padding:6px 14px;border-radius:8px;{{ request()->routeIs('complaints.*') && !request()->routeIs('complaints.create') ? 'background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3);color:#93c5fd;' : '' }} transition:all;">My Complaints</a>
                        <a href="{{ route('complaints.create') }}" class="block text-sm rounded-2xl" style="display:block;color:rgba(255,255,255,0.55);font-size:14px;padding:6px 14px;border-radius:8px;{{ request()->routeIs('complaints.create') ? 'background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3);color:#93c5fd;' : '' }} transition:all;">File Grievance</a>
                    @endif
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.complaints') }}" class="block text-sm rounded-2xl" style="display:block;color:rgba(255,255,255,0.55);font-size:14px;padding:6px 14px;border-radius:8px;{{ request()->routeIs('admin.complaints*') ? 'background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3);color:#93c5fd;' : '' }} transition:all;">Manage</a>
                        <a href="{{ route('admin.categories.index') }}" class="block text-sm rounded-2xl" style="display:block;color:rgba(255,255,255,0.55);font-size:14px;padding:6px 14px;border-radius:8px;{{ request()->routeIs('admin.categories*') ? 'background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3);color:#93c5fd;' : '' }} transition:all;">Categories</a>
                        <a href="{{ route('admin.analytics') }}" class="block text-sm rounded-2xl" style="display:block;color:rgba(255,255,255,0.55);font-size:14px;padding:6px 14px;border-radius:8px;{{ request()->routeIs('admin.analytics') ? 'background:rgba(59,130,246,0.15);border:1px solid rgba(59,130,246,0.3);color:#93c5fd;' : '' }} transition:all;">Analytics</a>
                    @endif
                </div>
            </div>

            <div style="border-top:1px solid rgba(255,255,255,0.08); padding:18px;">
                <div style="display:flex;align-items:center;gap:12px;padding:8px;border-radius:12px;background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.04);">
                    <div style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;background:rgba(59,130,246,0.25);color:#93c5fd;font-weight:600;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                    <div style="flex:1;min-width:0;">
                        <p style="font-size:13px;font-weight:600;color:#e8f4ff;margin:0;">{{ Auth::user()->name }}</p>
                        <p style="font-size:10px;color:rgba(255,255,255,0.4);margin:0;display:inline-flex;align-items:center;gap:8px;">@if(auth()->user()->role === 'admin')<span style="background:#1d4ed8;color:#fff;font-size:10px;letter-spacing:0.1em;padding:3px 10px;border-radius:4px;font-weight:600;">ADMIN</span>@else <span style="font-size:10px;color:rgba(255,255,255,0.45);">{{ ucwords(auth()->user()->role) }}</span>@endif</p>
                    </div>
                </div>
                <div style="margin-top:10px;display:flex;flex-direction:column;gap:8px;">
                    <a href="{{ route('profile.edit') }}" style="display:block;padding:10px;border-radius:8px;background:transparent;color:rgba(255,255,255,0.85);border:1px solid rgba(255,255,255,0.04);">View profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" style="width:100%;padding:10px;border-radius:8px;background:transparent;color:rgba(255,255,255,0.85);border:1px solid rgba(239,68,68,0.25);">Log out</button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="lg:hidden bg-slate-950/95 border-b border-white/10">
            <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between gap-3">
                <div class="flex items-center gap-3">
                    <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-sky-700/20 border border-sky-500/30 text-sky-200">
                        <x-portal-logo size="sm" :show-text="false" :href="route('dashboard')" class="text-white" />
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-slate-100">GrievancePortal</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button type="button" onclick="window.toggleTheme()" class="inline-flex items-center justify-center w-11 h-11 rounded-2xl border border-white/10 bg-slate-900 text-slate-100 shadow-sm hover:border-sky-300 transition-all" aria-label="Toggle theme">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v2"/><path d="M12 19v2"/><path d="M4.22 4.22l1.42 1.42"/><path d="M18.36 18.36l1.42 1.42"/><path d="M1 12h2"/><path d="M21 12h2"/><path d="M4.22 19.78l1.42-1.42"/><path d="M18.36 5.64l1.42-1.42"/><circle cx="12" cy="12" r="5"/></svg>
                    </button>
                    <button type="button" @click="mobileOpen = !mobileOpen" class="inline-flex items-center justify-center w-11 h-11 rounded-2xl border border-white/10 bg-slate-900 text-slate-100 shadow-sm hover:border-sky-300 transition-all" aria-label="Toggle menu">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            </div>

            <div x-show="mobileOpen" x-cloak x-transition class="border-t border-white/10 bg-slate-950/95 backdrop-blur-xl shadow-sm">
                <div class="px-4 py-5 space-y-2">
                    <a href="{{ route('dashboard') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-sky-500/10 text-sky-200' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">Dashboard</a>
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('complaints.index') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('complaints.*') && !request()->routeIs('complaints.create') ? 'bg-sky-500/10 text-sky-200' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">My Complaints</a>
                        <a href="{{ route('complaints.create') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('complaints.create') ? 'bg-sky-500/10 text-sky-200' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">File Grievance</a>
                    @endif
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.complaints') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.complaints*') ? 'bg-sky-500/10 text-sky-200' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">Manage</a>
                        <a href="{{ route('admin.categories.index') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.categories*') ? 'bg-sky-500/10 text-sky-200' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">Categories</a>
                        <a href="{{ route('admin.analytics') }}" class="block rounded-2xl px-4 py-3 text-sm font-semibold {{ request()->routeIs('admin.analytics') ? 'bg-sky-500/10 text-sky-200' : 'text-slate-300 hover:text-white hover:bg-white/5' }}">Analytics</a>
                    @endif
                    <div class="pt-4 mt-4 border-t border-white/10">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 hover:bg-white/5 text-slate-300">
                            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-sky-700/20 text-sky-200 font-semibold">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
                            <div>
                                <p class="text-sm font-semibold text-slate-100">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-400">View profile</p>
                            </div>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full rounded-2xl px-4 py-3 text-left text-sm font-semibold text-rose-400 hover:bg-rose-500/10">Log out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>[x-cloak] { display: none !important; }</style>
