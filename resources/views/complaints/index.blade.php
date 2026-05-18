<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">My Complaints</h2>
                <p class="mt-1 text-sm text-gray-500">History and status of all your submitted grievances.</p>
            </div>
            <a href="{{ route('complaints.create') }}" class="btn btn-primary inline-flex">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Complaint
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Search & Filter -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
                <form action="{{ route('complaints.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-grow">
                        <label for="search" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" class="form-input pl-10" placeholder="Search by title or description...">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-secondary whitespace-nowrap">Search</button>
                    @if(request('search'))
                        <a href="{{ route('complaints.index') }}" class="btn btn-outline text-gray-600 border-gray-300">Clear</a>
                    @endif
                </form>
            </div>

            <!-- Complaints List -->
            <div class="space-y-4">
                @forelse($complaints as $complaint)
                    <div class="card bg-white hover:shadow-md transition-shadow duration-200">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                            <div class="flex-grow">
                                <div class="flex items-center flex-wrap gap-2 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900">{{ $complaint->title }}</h3>
                                    @if($complaint->is_urgent)
                                        <span class="px-2 py-0.5 rounded text-xs font-bold bg-red-100 text-red-800 border border-red-200">URGENT</span>
                                    @endif
                                    @if($complaint->status === 'Pending')
                                        <span class="badge badge-pending">Pending</span>
                                    @elseif($complaint->status === 'In Progress')
                                        <span class="badge badge-in-progress">In Progress</span>
                                    @elseif($complaint->status === 'Resolved')
                                        <span class="badge badge-resolved">Resolved</span>
                                    @else
                                        <span class="badge bg-gray-100 text-gray-800">{{ $complaint->status }}</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 mb-3">{{ Str::limit($complaint->description, 150) }}</p>
                                <div class="flex flex-wrap items-center gap-4 text-xs font-medium text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                                        {{ $complaint->category->name ?? 'Uncategorized' }}
                                    </span>
                                    @if($complaint->category && $complaint->category->officer_name)
                                    <span class="flex items-center gap-1 text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded border border-indigo-100">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        Officer: {{ $complaint->category->officer_name }} ({{ $complaint->category->officer_phone }})
                                    </span>
                                    @endif
                                    @if($complaint->block || $complaint->room_number)
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ implode(', ', array_filter([$complaint->block, $complaint->floor, $complaint->room_number])) }}
                                    </span>
                                    @endif
                                    <span class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        {{ $complaint->created_at->format('M d, Y h:i A') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex sm:flex-col gap-2 min-w-[120px]">
                                <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-secondary w-full text-center">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card p-12 text-center bg-white">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">No complaints found</h3>
                        <p class="text-gray-500 mb-6">@if(request('search')) No results match your search query. @else You haven't submitted any complaints yet. @endif</p>
                        @if(request('search'))
                            <a href="{{ route('complaints.index') }}" class="btn btn-secondary">Clear Search</a>
                        @else
                            <a href="{{ route('complaints.create') }}" class="btn btn-primary">File a Complaint</a>
                        @endif
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>