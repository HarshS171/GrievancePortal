<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-white tracking-tight">Overview</h2>
                <p class="mt-2 text-sm text-slate-300">Track and manage your grievances seamlessly.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('complaints.create') }}" class="btn btn-primary group">
                    <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Complaint
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8 animate-slide-up">
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass-card" style="padding:12px;">
                    <div style="display:flex;align-items:center;gap:12px">
                        <div style="width:56px;height:56px;border-radius:12px;background:linear-gradient(135deg,rgba(99,102,241,0.12),rgba(59,130,246,0.08));display:flex;align-items:center;justify-content:center;color:#93c5fd">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <p style="font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:4px">Total</p>
                            <p style="font-size:28px;font-weight:800;color:#e8f4ff">{{ $totalComplaints }}</p>
                        </div>
                    </div>
                </div>

                <div class="glass-card" style="padding:12px;">
                    <div style="display:flex;align-items:center;gap:12px">
                        <div style="width:56px;height:56px;border-radius:12px;background:linear-gradient(135deg,rgba(250,204,21,0.08),rgba(245,158,11,0.06));display:flex;align-items:center;justify-content:center;color:#f59e0b">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p style="font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:4px">Pending</p>
                            <p style="font-size:28px;font-weight:800;color:#e8f4ff">{{ $pendingComplaints }}</p>
                        </div>
                    </div>
                </div>

                <div class="glass-card" style="padding:12px;">
                    <div style="display:flex;align-items:center;gap:12px">
                        <div style="width:56px;height:56px;border-radius:12px;background:linear-gradient(135deg,rgba(16,185,129,0.08),rgba(6,182,212,0.04));display:flex;align-items:center;justify-content:center;color:#34d399">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p style="font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase;letter-spacing:0.08em;margin-bottom:4px">Resolved</p>
                            <p style="font-size:28px;font-weight:800;color:#e8f4ff">{{ $resolvedComplaints }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Complaints -->
            <div class="glass-card p-0">
                <div style="padding:14px 18px;border-bottom:1px solid rgba(255,255,255,0.06);display:flex;justify-content:space-between;align-items:center;">
                    <h3 style="font-size:16px;font-weight:700;color:#e8f4ff;margin:0">Recent Complaints</h3>
                    <a href="{{ route('complaints.index') }}" style="font-size:13px;font-weight:600;color:#7dd3fc;display:flex;align-items:center;gap:8px">View all <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></a>
                </div>
                <div style="overflow-x:auto;">
                    <table style="width:100%;border-collapse:collapse;">
                        <thead style="background:rgba(255,255,255,0.02);">
                            <tr>
                                <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase">Title</th>
                                <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase">Category</th>
                                <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase">Status</th>
                                <th style="padding:12px 16px;text-align:left;font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase">Date</th>
                                <th style="padding:12px 16px;text-align:right;font-size:12px;font-weight:700;color:rgba(255,255,255,0.6);text-transform:uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentComplaints as $complaint)
                                <tr style="border-top:1px solid rgba(255,255,255,0.03);">
                                    <td style="padding:12px 16px;vertical-align:middle;">
                                        <div style="font-size:14px;font-weight:700;color:#e8f4ff">{{ Str::limit($complaint->title, 40) }}</div>
                                    </td>
                                    <td style="padding:12px 16px;vertical-align:middle;">
                                        <div style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:rgba(255,255,255,0.8);background:rgba(255,255,255,0.03);padding:6px 10px;border-radius:8px">{{ $complaint->category->name ?? 'N/A' }}</div>
                                    </td>
                                    <td style="padding:12px 16px;vertical-align:middle;">
                                        @if($complaint->status === 'Pending')
                                            <span class="status-pending">Pending</span>
                                        @elseif($complaint->status === 'In Progress')
                                            <span class="status-inprogress">In Progress</span>
                                        @elseif($complaint->status === 'Resolved')
                                            <span class="status-resolved">Resolved</span>
                                        @elseif($complaint->status === 'Rejected')
                                            <span style="background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.12);padding:6px 10px;border-radius:8px;font-weight:700">Rejected</span>
                                        @else
                                            <span style="background:rgba(255,255,255,0.07);color:rgba(255,255,255,0.5);border:1px solid rgba(255,255,255,0.12);padding:6px 10px;border-radius:8px;font-weight:700">{{ $complaint->status }}</span>
                                        @endif
                                    </td>
                                    <td style="padding:12px 16px;vertical-align:middle;color:rgba(255,255,255,0.6);font-weight:600">{{ $complaint->created_at->format('M d, Y') }}</td>
                                    <td style="padding:12px 16px;vertical-align:middle;text-align:right;">
                                        <a href="{{ route('complaints.show', $complaint) }}" style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:8px;background:rgba(255,255,255,0.03);color:#7dd3fc;opacity:0;transition:opacity .15s ease" class="group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="padding:28px;text-align:center;color:rgba(255,255,255,0.65)">
                                        <div style="display:inline-flex;align-items:center;justify-content:center;width:64px;height:64px;border-radius:999px;background:rgba(255,255,255,0.03);margin:0 auto 12px">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                        </div>
                                        <h3 style="font-size:15px;font-weight:700;color:#e8f4ff;margin-bottom:6px">No complaints found</h3>
                                        <p style="font-size:13px;color:rgba(255,255,255,0.6);margin-bottom:12px">You haven't submitted any complaints yet.</p>
                                        <a href="{{ route('complaints.create') }}" class="btn-primary">File your first complaint</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>