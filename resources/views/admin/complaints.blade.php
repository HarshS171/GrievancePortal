<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Manage Complaints</h2>
                @php
                    $isSuperintendent = auth()->user()->role === 'superintendent';
                    $recordCount = $isSuperintendent
                        ? ($oneStarComplaints->count() + $overdueComplaints->count())
                        : $complaints->count();
                @endphp
                <p class="mt-2 text-sm text-slate-500 font-medium">Total of <span class="font-bold text-portal-700">{{ $recordCount }}</span> records found in the system.</p>
            </div>
            <div class="flex gap-3">
                <button class="btn btn-secondary inline-flex border-slate-200 text-slate-700 hover:border-slate-300 hover:bg-slate-50 shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter List
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 animate-slide-up">
            <!-- Search and Filter Bar -->
            <div class="bg-white/80 backdrop-blur-xl p-5 rounded-2xl shadow-sm border border-slate-200/60 mb-8">
                <form action="{{ route('admin.complaints') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-grow w-full relative group">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 group-focus-within:text-portal-700 transition-colors">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-portal-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, description, or ID..." class="form-input pl-11 py-2.5 bg-white w-full" >
                        </div>
                    </div>
                    
                    <div class="w-full md:w-56 group">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 group-focus-within:text-portal-700 transition-colors">Status</label>
                        <select name="status" class="form-select py-2.5 bg-white w-full">
                            <option value="">All Statuses</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="w-full md:w-56 group">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 group-focus-within:text-portal-700 transition-colors">Category</label>
                        <select name="category_id" class="form-select py-2.5 bg-white w-full">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex gap-3 w-full md:w-auto h-[42px]">
                        <button type="submit" class="btn btn-primary whitespace-nowrap flex-grow md:flex-grow-0 px-6 h-full">
                            Apply Filters
                        </button>
                        @if(request('search') || request('status') || request('category_id'))
                            <a href="{{ route('admin.complaints') }}" class="btn btn-secondary border-slate-200 text-slate-600 hover:text-slate-900 whitespace-nowrap h-full px-6 flex items-center justify-center">Clear</a>
                        @endif
                    </div>
                </form>
            </div>

            @php $isSuperintendent = auth()->user()->role === 'superintendent'; @endphp

            @if($isSuperintendent)
                @if($oneStarComplaints->isEmpty() && $overdueComplaints->isEmpty())
                    <div class="card p-16 text-center bg-white border-dashed border-2 border-slate-200">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-50 mb-6 shadow-inner border border-slate-100">
                            <svg class="h-10 w-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">No Superintendent Complaints Found</h3>
                        <p class="text-slate-500 font-medium max-w-md mx-auto">There are no 1-star feedback complaints or unresolved complaints older than 48 hours right now.</p>
                    </div>
                @endif

                @if($oneStarComplaints->isNotEmpty())
                    <div class="mb-8">
                        <div class="flex items-center justify-between mb-5 gap-4">
                            <div>
                                <h3 class="text-2xl font-extrabold text-slate-900">1-Star Rated Complaints</h3>
                                <p class="text-sm text-slate-500">Complaints resolved by staff but flagged with a 1-star citizen rating.</p>
                            </div>
                            <span class="inline-flex items-center gap-2 rounded-full bg-rose-50 px-4 py-2 text-sm font-semibold text-rose-700 border border-rose-100">{{ $oneStarComplaints->count() }} complaint(s)</span>
                        </div>

                        <div class="card p-0 overflow-hidden bg-white shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100 mb-10">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50/80">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Complaint</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Citizen</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Rating</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Resolved On</th>
                                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-slate-100">
                                        @foreach($oneStarComplaints as $complaint)
                                            <tr class="hover:bg-slate-50/60 transition-colors group">
                                                <td class="px-6 py-5">
                                                    <div class="text-sm font-extrabold text-slate-900 mb-1.5 group-hover:text-portal-700 transition-colors">{{ Str::limit($complaint->title, 50) }}</div>
                                                    <div class="text-xs text-slate-400 font-bold tracking-wider">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }} · {{ $complaint->category->name ?? 'N/A' }}</div>
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap">
                                                    <div class="flex items-center gap-3">
                                                        @if($complaint->is_anonymous)
                                                            <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-500 border border-slate-200">?</div>
                                                            <div class="text-sm font-bold text-slate-500 italic">Anonymous</div>
                                                        @else
                                                            <div class="w-9 h-9 rounded-full bg-portal-100 flex items-center justify-center text-sm font-bold text-portal-700 border border-portal-200/60 shadow-sm">
                                                                {{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}
                                                            </div>
                                                            <div class="text-sm font-bold text-slate-900">{{ $complaint->user->name ?? 'Unknown' }}</div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap">
                                                    <span class="inline-flex items-center gap-2 rounded-full bg-rose-50 px-3 py-1 text-sm font-semibold text-rose-700 border border-rose-100">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                        1 Star
                                                    </span>
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-500">
                                                    {{ $complaint->updated_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-secondary text-sm px-4 py-2 border-slate-200 text-slate-700 hover:text-portal-700 hover:border-portal-200 shadow-sm">Manage</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                @if($overdueComplaints->isNotEmpty())
                    <div>
                        <div class="flex items-center justify-between mb-5 gap-4">
                            <div>
                                <h3 class="text-2xl font-extrabold text-slate-900">Overdue Complaints (48+ Hours)</h3>
                                <p class="text-sm text-slate-500">Complaints still unresolved more than 48 hours after submission.</p>
                            </div>
                            <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-4 py-2 text-sm font-semibold text-amber-700 border border-amber-100">{{ $overdueComplaints->count() }} complaint(s)</span>
                        </div>

                        <div class="card p-0 overflow-hidden bg-white shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50/80">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Complaint</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Citizen</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Submitted</th>
                                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-slate-100">
                                        @foreach($overdueComplaints as $complaint)
                                            <tr class="hover:bg-slate-50/60 transition-colors group">
                                                <td class="px-6 py-5">
                                                    <div class="text-sm font-extrabold text-slate-900 mb-1.5 group-hover:text-portal-700 transition-colors">{{ Str::limit($complaint->title, 50) }}</div>
                                                    <div class="text-xs text-slate-400 font-bold tracking-wider">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }} · {{ $complaint->category->name ?? 'N/A' }}</div>
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap">
                                                    <div class="flex items-center gap-3">
                                                        @if($complaint->is_anonymous)
                                                            <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-500 border border-slate-200">?</div>
                                                            <div class="text-sm font-bold text-slate-500 italic">Anonymous</div>
                                                        @else
                                                            <div class="w-9 h-9 rounded-full bg-portal-100 flex items-center justify-center text-sm font-bold text-portal-700 border border-portal-200/60 shadow-sm">
                                                                {{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}
                                                            </div>
                                                            <div class="text-sm font-bold text-slate-900">{{ $complaint->user->name ?? 'Unknown' }}</div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap">
                                                    <span class="badge {{ $complaint->status === 'Pending' ? 'badge-pending' : 'badge-in-progress' }}">{{ $complaint->status }}</span>
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-500">
                                                    {{ $complaint->created_at->format('M d, Y') }}
                                                </td>
                                                <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-secondary text-sm px-4 py-2 border-slate-200 text-slate-700 hover:text-portal-700 hover:border-portal-200 shadow-sm">Manage</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="card p-0 overflow-hidden bg-white shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50/80">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Grievance Details</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Citizen</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                                    <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-100">
                                @foreach($complaints as $complaint)
                                    <tr class="hover:bg-slate-50/60 transition-colors group">
                                        <td class="px-6 py-5">
                                            <div class="text-sm font-extrabold text-slate-900 mb-1.5 group-hover:text-portal-700 transition-colors">{{ Str::limit($complaint->title, 50) }}</div>
                                            <div class="flex items-center gap-2">
                                                <span class="px-2.5 py-1 rounded-md text-xs font-bold bg-portal-50 text-portal-700 border border-portal-100/60 flex items-center gap-1">
                                                    <div class="w-1.5 h-1.5 rounded-full bg-portal-500"></div>
                                                    {{ $complaint->category->name ?? 'N/A' }}
                                                </span>
                                                <span class="text-xs text-slate-400 font-bold tracking-wider">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center gap-3">
                                                @if($complaint->is_anonymous)
                                                    <div class="w-9 h-9 rounded-full bg-slate-100 flex items-center justify-center text-sm font-bold text-slate-500 border border-slate-200">?</div>
                                                    <div class="text-sm font-bold text-slate-500 italic">Anonymous</div>
                                                @else
                                                    <div class="w-9 h-9 rounded-full bg-portal-100 flex items-center justify-center text-sm font-bold text-portal-700 border border-portal-200/60 shadow-sm">
                                                        {{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div class="text-sm font-bold text-slate-900">{{ $complaint->user->name ?? 'Unknown' }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex flex-col gap-1.5 items-start">
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
                                                
                                                @if($complaint->is_escalated)
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-extrabold tracking-wider bg-rose-50 text-rose-700 border border-rose-200/60">
                                                        <span class="w-1 h-1 rounded-full bg-rose-500 animate-pulse"></span>
                                                        ESCALATED
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-sm font-medium text-slate-500">
                                            {{ $complaint->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-secondary text-sm px-4 py-2 border-slate-200 text-slate-700 hover:text-portal-700 hover:border-portal-200 shadow-sm">Manage</a>
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