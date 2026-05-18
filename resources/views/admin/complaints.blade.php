<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Manage All Complaints</h2>
                <p class="mt-1 text-sm text-gray-500">Total of {{ $complaints->count() }} records found in the system.</p>
            </div>
            <div class="flex gap-3">
                <button class="btn btn-secondary inline-flex">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter List
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter Bar -->
            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-6">
                <form action="{{ route('admin.complaints') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-grow w-full relative">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by complaint title or ID..." class="form-input pl-10 w-full" >
                        </div>
                    </div>
                    
                    <div class="w-full md:w-48">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Status</label>
                        <select name="status" class="form-input w-full">
                            <option value="">All Statuses</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="w-full md:w-48">
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Category</label>
                        <select name="category_id" class="form-input w-full">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-2 w-full md:w-auto">
                        <button type="submit" class="btn btn-primary whitespace-nowrap flex-grow md:flex-grow-0">
                            Apply Filters
                        </button>
                        @if(request('search') || request('status') || request('category_id'))
                            <a href="{{ route('admin.complaints') }}" class="btn btn-outline text-gray-600 border-gray-300 whitespace-nowrap">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            @if($complaints->isEmpty())
                <div class="card p-12 text-center bg-white">
                    <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">No Complaints Found</h3>
                    <p class="text-gray-500">Adjust your search criteria or check back later for new submissions.</p>
                </div>
            @else
                <div class="card p-0 overflow-hidden bg-white">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Grievance Details</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Citizen</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($complaints as $complaint)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900 mb-1">{{ Str::limit($complaint->title, 50) }}</div>
                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-0.5 rounded text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">{{ $complaint->category->name ?? 'N/A' }}</span>
                                                <span class="text-xs text-gray-500 font-mono">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                @if($complaint->is_anonymous)
                                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500">?</div>
                                                    <div class="text-sm font-medium text-gray-500 italic">Anonymous</div>
                                                @else
                                                    <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-600">
                                                        {{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $complaint->user->name ?? 'Unknown' }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($complaint->status === 'Pending')
                                                <span class="badge badge-pending">Pending</span>
                                            @elseif($complaint->status === 'In Progress')
                                                <span class="badge badge-in-progress">In Progress</span>
                                            @elseif($complaint->status === 'Resolved')
                                                <span class="badge badge-resolved">Resolved</span>
                                            @else
                                                <span class="badge bg-gray-100 text-gray-800">{{ $complaint->status }}</span>
                                            @endif
                                            @if($complaint->is_escalated)
                                                <span class="ml-1 px-2 py-0.5 rounded text-xs font-bold bg-orange-100 text-orange-800 border border-orange-200">ESCALATED</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $complaint->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-secondary text-xs px-3 py-1.5">Manage</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>