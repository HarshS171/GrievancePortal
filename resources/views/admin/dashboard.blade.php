<x-app-layout>
    <x-slot name="header">
        <h2 style="margin-bottom: 0; color: var(--text-main);">Administrative Control Center</h2>
        <p style="color: var(--text-muted); font-size: 0.9375rem; margin-top: 4px;">System-wide overview of grievances and citizens.</p>
    </x-slot>

    <div class="section-py">
        <div class="container">
            <div class="grid" style="grid-template-columns: repeat(4, 1fr); gap: 24px;">
                <!-- Total -->
                <div class="card stat-card card-hover">
                    <div style="width: 48px; height: 48px; background: rgba(99, 102, 241, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin: 0 auto 16px;">
                        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <div class="stat-value">{{ $totalComplaints }}</div>
                    <div class="stat-label">Total Complaints</div>
                </div>

                <!-- Pending -->
                <div class="card stat-card card-hover" style="border-bottom: 4px solid var(--warning);">
                    <div style="width: 48px; height: 48px; background: rgba(245, 158, 11, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--warning); margin: 0 auto 16px;">
                        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="stat-value" style="color: var(--warning);">{{ $pendingComplaints }}</div>
                    <div class="stat-label">Pending Action</div>
                </div>

                <!-- Resolved -->
                <div class="card stat-card card-hover" style="border-bottom: 4px solid var(--success);">
                    <div style="width: 48px; height: 48px; background: rgba(16, 185, 129, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--success); margin: 0 auto 16px;">
                        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="stat-value" style="color: var(--success);">{{ $resolvedComplaints }}</div>
                    <div class="stat-label">Successfully Resolved</div>
                </div>

                <!-- Users -->
                <div class="card stat-card card-hover" style="border-bottom: 4px solid #a855f7;">
                    <div style="width: 48px; height: 48px; background: rgba(168, 85, 247, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #a855f7; margin: 0 auto 16px;">
                        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div class="stat-value" style="color: #a855f7;">{{ $totalUsers }}</div>
                    <div class="stat-label">Active Citizens</div>
                </div>
            </div>

            <div style="margin-top: 48px; display: grid; grid-template-columns: 2fr 1fr; gap: 32px;">
                <div class="card">
                    <h3 style="font-size: 1.5rem; margin-bottom: 24px;">Recent System Overview</h3>
                    <div style="padding: 48px; text-align: center; background: #f8fafc; border-radius: var(--radius-lg); border: 2px dashed var(--border);">
                        <svg style="width: 64px; height: 64px; color: var(--border); margin-bottom: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <p style="margin-bottom: 0; font-weight: 600;">System insights will appear here as more data is processed.</p>
                    </div>
                </div>

                <div class="card">
                    <h3 style="font-size: 1.25rem; margin-bottom: 24px;">Quick Management</h3>
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <a href="{{ route('admin.complaints') }}" class="btn btn-primary" style="width: 100%;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                            Review All Complaints
                        </a>
                        <button class="btn btn-secondary" style="width: 100%; opacity: 0.6; cursor: not-allowed;">
                            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Export System Report
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
