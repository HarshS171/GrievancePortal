<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Admin Overview</h2>
                <p class="mt-2 text-sm text-slate-500">System-wide statistics and grievance management.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.complaints') }}" class="btn btn-primary group">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    Manage Complaints
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 animate-slide-up">
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users -->
                <div class="card relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center p-2">
                        <div class="p-4 rounded-2xl bg-blue-50/80 text-blue-600 mr-5 border border-blue-100/50 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Total Users</p>
                            <p class="text-3xl font-extrabold text-slate-900">{{ $totalUsers }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Complaints -->
                <div class="card relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-portal-50 rounded-bl-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center p-2">
                        <div class="p-4 rounded-2xl bg-portal-50/80 text-portal-700 mr-5 border border-portal-100/50 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Complaints</p>
                            <p class="text-3xl font-extrabold text-slate-900">{{ $totalComplaints }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Pending -->
                <div class="card relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-amber-50 rounded-bl-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center p-2">
                        <div class="p-4 rounded-2xl bg-amber-50/80 text-amber-600 mr-5 border border-amber-100/50 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Pending</p>
                            <p class="text-3xl font-extrabold text-slate-900">{{ $pendingComplaints }}</p>
                        </div>
                    </div>
                </div>

                <!-- Resolved -->
                <div class="card relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center p-2">
                        <div class="p-4 rounded-2xl bg-emerald-50/80 text-emerald-600 mr-5 border border-emerald-100/50 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Resolved</p>
                            <p class="text-3xl font-extrabold text-slate-900">{{ $resolvedComplaints }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manage Actions -->
            <div class="card p-12 text-center bg-gradient-to-br from-portal-950 via-portal-800 to-portal-700 text-white relative overflow-hidden border-0 shadow-lg shadow-portal-900/30">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-emerald-500/15 rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/10 backdrop-blur-md mb-6 shadow-inner border border-white/20">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-3 tracking-tight">Manage Grievances System</h3>
                    <p class="text-portal-100 mb-8 max-w-xl mx-auto text-lg leading-relaxed">Access the centralized administrative panel to review, assign, update statuses, and add official remarks to citizen complaints efficiently.</p>
                    <a href="{{ route('admin.complaints') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 text-base font-bold bg-white text-portal-700 rounded-xl hover:bg-slate-50 transition-all shadow-md hover:shadow-xl hover:-translate-y-1">
                        Go to Control Panel
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
