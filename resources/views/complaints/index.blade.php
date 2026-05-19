<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">My Complaints</h2>
                <p class="mt-2 text-sm text-slate-500">History and current status of all your submitted grievances.</p>
            </div>
            <a href="{{ route('complaints.create') }}" class="btn btn-primary inline-flex group shadow-lg shadow-portal-200">
                <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Complaint
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 animate-slide-up">
            
            <!-- Search & Filter -->
            <div class="bg-white/80 backdrop-blur-xl p-5 rounded-2xl shadow-sm border border-slate-200/60 mb-8">
                <form action="{{ route('complaints.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-grow">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-portal-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-input pl-11 py-3 bg-white" placeholder="Search by title, description or ID...">
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="btn btn-primary px-6 whitespace-nowrap">Search</button>
                        @if(request('search'))
                            <a href="{{ route('complaints.index') }}" class="btn btn-secondary px-6 border-slate-200 text-slate-600 hover:text-slate-900">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Complaints List -->
            <div class="space-y-5">
                @forelse($complaints as $complaint)
                    <div class="card bg-white p-6 md:p-8 hover:border-portal-100 group transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:items-start justify-between gap-6">
                            <div class="flex-grow space-y-4">
                                <div class="flex items-start justify-between gap-4">
                                    <h3 class="text-xl font-bold text-slate-900 group-hover:text-portal-700 transition-colors leading-tight">{{ $complaint->title }}</h3>
                                    <div class="flex-shrink-0 flex gap-2">
                                        @if($complaint->is_urgent)
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200/60">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                                URGENT
                                            </span>
                                        @endif
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
                                    </div>
                                </div>
                                
                                <p class="text-sm font-medium text-slate-600 leading-relaxed max-w-4xl">{{ Str::limit($complaint->description, 200) }}</p>
                                
                                <div class="flex flex-wrap items-center gap-x-6 gap-y-3 pt-2">
                                    <div class="flex items-center gap-2 text-sm font-semibold text-slate-700 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                                        <div class="w-6 h-6 rounded-md bg-portal-100 text-portal-700 flex items-center justify-center">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                        </div>
                                        {{ $complaint->category->name ?? 'Uncategorized' }}
                                    </div>
                                    
                                    @if($complaint->category && $complaint->category->officer_name)
                                    <div class="flex items-center gap-2 text-sm font-semibold text-portal-700 bg-portal-50 px-3 py-1.5 rounded-lg border border-portal-100/50">
                                        <svg class="w-4 h-4 text-portal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Officer: {{ $complaint->category->officer_name }}
                                    </div>
                                    @endif
                                    
                                    @if($complaint->block || $complaint->room_number)
                                    <div class="flex items-center gap-1.5 text-sm font-medium text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ implode(', ', array_filter([$complaint->block, $complaint->floor, $complaint->room_number])) }}
                                    </div>
                                    @endif
                                    
                                    <div class="flex items-center gap-1.5 text-sm font-medium text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $complaint->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col gap-3 min-w-[140px] border-t md:border-t-0 md:border-l border-slate-100 pt-4 md:pt-0 md:pl-6 justify-center">
                                <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-secondary w-full text-center shadow-none hover:border-portal-200 hover:text-portal-700">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card p-16 text-center bg-white border-dashed border-2 border-slate-200">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 mb-6 shadow-inner border border-slate-100">
                            <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">No complaints found</h3>
                        <p class="text-slate-500 font-medium mb-8 max-w-md mx-auto">
                            @if(request('search')) 
                                We couldn't find any complaints matching your search query. Try adjusting your keywords.
                            @else 
                                You haven't submitted any complaints yet. Your grievance history will appear here.
                            @endif
                        </p>
                        @if(request('search'))
                            <a href="{{ route('complaints.index') }}" class="btn btn-secondary px-8">Clear Search</a>
                        @else
                            <a href="{{ route('complaints.create') }}" class="btn btn-primary px-8 shadow-lg shadow-portal-200">File a Complaint</a>
                        @endif
                    </div>
                @endforelse
            </div>

            <!-- Pagination if exists -->
            @if(method_exists($complaints, 'links'))
                <div class="mt-8">
                    {{ $complaints->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>