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
                <div class="glass-card relative" style="position:relative;">
                    <div style="position:absolute;top:1rem;right:1rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-size:18px;color:rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <div class="stat-label">Total Users</div>
                        <div class="stat-number">{{ $totalUsers }}</div>
                    </div>
                </div>

                <!-- Total Complaints -->
                <div class="glass-card relative" style="position:relative;">
                    <div style="position:absolute;top:1rem;right:1rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-size:18px;color:rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/></svg>
                    </div>
                    <div>
                        <div class="stat-label">Complaints</div>
                        <div class="stat-number">{{ $totalComplaints }}</div>
                    </div>
                </div>
                
                <!-- Pending -->
                <div class="glass-card relative" style="position:relative;">
                    <div style="position:absolute;top:1rem;right:1rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-size:18px;color:rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <div class="stat-label">Pending</div>
                        <div class="stat-number">{{ $pendingComplaints }}</div>
                    </div>
                </div>

                <!-- Resolved -->
                <div class="glass-card relative" style="position:relative;">
                    <div style="position:absolute;top:1rem;right:1rem;width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-size:18px;color:rgba(255,255,255,0.25);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                    </div>
                    <div>
                        <div class="stat-label">Resolved</div>
                        <div class="stat-number">{{ $resolvedComplaints }}</div>
                    </div>
                </div>
            </div>

            <!-- Manage Actions -->
            <div class="glass-card p-12 text-center" style="background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 100%); border:1px solid rgba(255,255,255,0.12); border-radius:16px; padding:3rem 2rem; text-align:center; color:#fff;">
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-emerald-500/15 rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <div class="inline-flex items-center justify-center" style="width:64px;height:64px;border-radius:50%;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;margin:0 auto 16px;font-size:24px;color:#fff;">
                        <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 style="font-size:22px;font-weight:600;margin-bottom:8px;color:#fff;">Manage Grievances System</h3>
                    <p style="font-size:14px;color:rgba(255,255,255,0.7);max-width:480px;margin:0 auto 20px;line-height:1.6;">Access the centralized administrative panel to review, assign, update statuses, and add official remarks to citizen complaints efficiently.</p>
                    <a href="{{ route('admin.complaints') }}" class="btn-primary">Go to Control Panel</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
