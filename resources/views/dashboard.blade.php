<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}</h2>
                <p class="mt-1 text-sm text-gray-500">Submit and track your grievances from your personal dashboard.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('complaints.create') }}" class="btn btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Complaint
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="card flex items-center p-6 border-l-4 border-indigo-500">
                    <div class="p-3 rounded-full bg-indigo-100 text-indigo-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Complaints</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $totalComplaints }}</p>
                    </div>
                </div>
                
                <div class="card flex items-center p-6 border-l-4 border-amber-500">
                    <div class="p-3 rounded-full bg-amber-100 text-amber-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Pending</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $pendingComplaints }}</p>
                    </div>
                </div>

                <div class="card flex items-center p-6 border-l-4 border-emerald-500">
                    <div class="p-3 rounded-full bg-emerald-100 text-emerald-600 mr-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Resolved</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $resolvedComplaints }}</p>
                    </div>
                </div>
            </div>

            <!-- Recent Complaints -->
            <div class="card p-0 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Complaints</h3>
                    <a href="{{ route('complaints.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all history &rarr;</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentComplaints as $complaint)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ Str::limit($complaint->title, 40) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-500">{{ $complaint->category->name ?? 'N/A' }}</div>
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
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $complaint->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('complaints.show', $complaint) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
                                        <p class="text-base font-medium text-gray-900">No complaints found</p>
                                        <p class="text-sm text-gray-500 mt-1">You haven't submitted any complaints yet.</p>
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