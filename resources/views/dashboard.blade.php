<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Overview</h2>
                <p class="mt-2 text-sm text-slate-500">Track and manage your grievances seamlessly.</p>
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
                <!-- Total Card -->
                <div class="card relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-indigo-50 rounded-bl-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center p-2">
                        <div class="p-4 rounded-2xl bg-indigo-50/80 text-indigo-600 mr-5 border border-indigo-100/50 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Total</p>
                            <p class="text-4xl font-extrabold text-slate-900">{{ $totalComplaints }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Pending Card -->
                <div class="card relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-amber-50 rounded-bl-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center p-2">
                        <div class="p-4 rounded-2xl bg-amber-50/80 text-amber-600 mr-5 border border-amber-100/50 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Pending</p>
                            <p class="text-4xl font-extrabold text-slate-900">{{ $pendingComplaints }}</p>
                        </div>
                    </div>
                </div>

                <!-- Resolved Card -->
                <div class="card relative overflow-hidden group">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-16 -mt-16 transition-transform group-hover:scale-110"></div>
                    <div class="relative z-10 flex items-center p-2">
                        <div class="p-4 rounded-2xl bg-emerald-50/80 text-emerald-600 mr-5 border border-emerald-100/50 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-1">Resolved</p>
                            <p class="text-4xl font-extrabold text-slate-900">{{ $resolvedComplaints }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Complaints -->
            <div class="card p-0 overflow-hidden border-slate-200/60 shadow-sm">
                <div class="px-6 py-5 border-b border-slate-100 flex justify-between items-center bg-white/50">
                    <h3 class="text-lg font-bold text-slate-800">Recent Complaints</h3>
                    <a href="{{ route('complaints.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors flex items-center gap-1">
                        View all <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-100">
                        <thead class="bg-slate-50/80">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-50">
                            @forelse($recentComplaints as $complaint)
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-slate-800">{{ Str::limit($complaint->title, 40) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-600 bg-slate-100 px-2.5 py-1 rounded-md">
                                            {{ $complaint->category->name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($complaint->status === 'Pending')
                                            <span class="badge badge-pending">Pending</span>
                                        @elseif($complaint->status === 'In Progress')
                                            <span class="badge badge-in-progress">In Progress</span>
                                        @elseif($complaint->status === 'Resolved')
                                            <span class="badge badge-resolved">Resolved</span>
                                        @elseif($complaint->status === 'Rejected')
                                            <span class="badge badge-rejected">Rejected</span>
                                        @else
                                            <span class="badge bg-slate-100 text-slate-800 border-slate-200">{{ $complaint->status }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-medium">
                                        {{ $complaint->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('complaints.show', $complaint) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all opacity-0 group-hover:opacity-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                        </div>
                                        <h3 class="text-base font-bold text-slate-900 mb-1">No complaints found</h3>
                                        <p class="text-sm text-slate-500 mb-4">You haven't submitted any complaints yet.</p>
                                        <a href="{{ route('complaints.create') }}" class="btn btn-outline">File your first complaint</a>
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