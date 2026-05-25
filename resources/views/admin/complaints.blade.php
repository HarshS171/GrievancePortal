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
            <div class="glass-card mb-8">
                <form action="{{ route('admin.complaints') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-grow w-full relative group">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 group-focus-within:text-portal-700 transition-colors">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-portal-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title, description, or ID..." class="form-input pl-11 py-2.5 w-full" >
                        </div>
                    </div>
                    
                    <div class="w-full md:w-56 group">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 group-focus-within:text-portal-700 transition-colors">Status</label>
                        <select name="status" class="form-input py-2.5 w-full">
                            <option value="">All Statuses</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                            <option value="Rejected" {{ request('status') == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="w-full md:w-56 group">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2 group-focus-within:text-portal-700 transition-colors">Category</label>
                        <select name="category_id" class="form-input py-2.5 w-full">
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

                        <div class="glass-card p-0 overflow-hidden mb-10" style="overflow-x:auto;">
                            <table class="min-w-full" style="width:100%;border-collapse:collapse;">
                                    <thead style="background:rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.1);">
                                        <tr>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Complaint</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Citizen</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Rating</th>
                                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Resolved On</th>
                                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background:transparent;">
                                        @foreach($oneStarComplaints as $complaint)
                                            <tr style="border-top:1px solid rgba(255,255,255,0.06);" class="group">
                                                <td style="padding:14px 16px;vertical-align:top;width:50%">
                                                    <div style="font-size:14px;font-weight:600;color:#e8f4ff;margin-bottom:6px;">{{ Str::limit($complaint->title, 50) }}</div>
                                                    <div style="font-size:12px;color:rgba(255,255,255,0.35);font-family:monospace">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }} · {{ $complaint->category->name ?? 'N/A' }}</div>
                                                </td>
                                                <td style="padding:14px 16px;vertical-align:top;">
                                                    <div style="display:flex;align-items:center;gap:12px;">
                                                        @if($complaint->is_anonymous)
                                                            <div style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:rgba(255,255,255,0.55);">?</div>
                                                            <div style="font-size:14px;color:rgba(255,255,255,0.55);font-style:italic">Anonymous</div>
                                                        @else
                                                            <div style="width:36px;height:36px;border-radius:50%;background:rgba(59,130,246,0.12);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:#93c5fd">{{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}</div>
                                                            <div style="font-size:14px;color:#e8f4ff">{{ $complaint->user->name ?? 'Unknown' }}</div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td style="padding:14px 16px;vertical-align:top;">
                                                    <span style="display:inline-flex;align-items:center;gap:8px;border-radius:20px;padding:3px 12px;font-size:12px;font-weight:600;" class="{{ $complaint->status === 'Pending' ? 'status-pending' : ($complaint->status === 'In Progress' ? 'status-inprogress' : ($complaint->status === 'Resolved' ? 'status-resolved' : 'status-closed')) }}">@if($complaint->status === 'Pending')Pending @elseif($complaint->status === 'In Progress')In Progress @elseif($complaint->status === 'Resolved')Resolved @else {{ $complaint->status }} @endif</span>
                                                </td>
                                                <td style="padding:14px 16px;vertical-align:top;color:rgba(255,255,255,0.3);font-size:12px">{{ $complaint->updated_at->format('M d, Y') }}</td>
                                                <td style="padding:14px 16px;vertical-align:top;text-align:right;">
                                                    <a href="{{ route('admin.complaints.show', $complaint->id) }}" style="background:transparent;border:1px solid rgba(255,255,255,0.18);color:rgba(255,255,255,0.65);border-radius:6px;padding:5px 14px;font-size:12px;">Manage</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

                        <div class="glass-card p-0 overflow-hidden mb-10" style="overflow-x:auto;">
                            <table class="min-w-full" style="width:100%;border-collapse:collapse;">
                                <thead style="background:rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.1);">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Complaint</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Citizen</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                        <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Submitted</th>
                                        <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="background:transparent;">
                                    @foreach($overdueComplaints as $complaint)
                                        <tr style="border-top:1px solid rgba(255,255,255,0.06);" class="group">
                                            <td style="padding:14px 16px;vertical-align:top;width:50%">
                                                <div style="font-size:14px;font-weight:600;color:#e8f4ff;margin-bottom:6px;">{{ Str::limit($complaint->title, 50) }}</div>
                                                <div style="font-size:12px;color:rgba(255,255,255,0.35);font-family:monospace">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }} · {{ $complaint->category->name ?? 'N/A' }}</div>
                                            </td>
                                            <td style="padding:14px 16px;vertical-align:top;">
                                                <div style="display:flex;align-items:center;gap:12px;">
                                                    @if($complaint->is_anonymous)
                                                        <div style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:rgba(255,255,255,0.55);">?</div>
                                                        <div style="font-size:14px;color:rgba(255,255,255,0.55);font-style:italic">Anonymous</div>
                                                    @else
                                                        <div style="width:36px;height:36px;border-radius:50%;background:rgba(59,130,246,0.12);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:#93c5fd">{{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}</div>
                                                        <div style="font-size:14px;color:#e8f4ff">{{ $complaint->user->name ?? 'Unknown' }}</div>
                                                    @endif
                                                </div>
                                            </td>
                                            <td style="padding:14px 16px;vertical-align:top;">
                                                <span style="display:inline-flex;align-items:center;gap:8px;border-radius:20px;padding:3px 12px;font-size:12px;font-weight:600;" class="{{ $complaint->status === 'Pending' ? 'status-pending' : ($complaint->status === 'In Progress' ? 'status-inprogress' : ($complaint->status === 'Resolved' ? 'status-resolved' : 'status-closed')) }}">{{ $complaint->status }}</span>
                                            </td>
                                            <td style="padding:14px 16px;vertical-align:top;color:rgba(255,255,255,0.3);font-size:12px">{{ $complaint->created_at->format('M d, Y') }}</td>
                                            <td style="padding:14px 16px;vertical-align:top;text-align:right;">
                                                <a href="{{ route('admin.complaints.show', $complaint->id) }}" style="background:transparent;border:1px solid rgba(255,255,255,0.18);color:rgba(255,255,255,0.65);border-radius:6px;padding:5px 14px;font-size:12px;">Manage</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @else
                <div class="glass-card p-0 overflow-hidden" style="overflow-x:auto;">
                    <table class="min-w-full" style="width:100%;border-collapse:collapse;">
                        <thead style="background:rgba(255,255,255,0.05);border-bottom:1px solid rgba(255,255,255,0.1);">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Grievance Details</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Citizen</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody style="background:transparent;">
                            @foreach($complaints as $complaint)
                                <tr style="border-top:1px solid rgba(255,255,255,0.06);" class="group">
                                    <td style="padding:14px 16px;vertical-align:top;width:50%">
                                        <div style="font-size:14px;font-weight:600;color:#e8f4ff;margin-bottom:6px;">{{ Str::limit($complaint->title, 50) }}</div>
                                        <div style="display:flex;align-items:center;gap:8px;">
                                            <span style="display:inline-flex;align-items:center;gap:5px;padding:2px 10px;border-radius:6px;font-size:12px;font-weight:600;background:rgba(59,130,246,0.1);color:#93c5fd;border:1px solid rgba(59,130,246,0.2);">
                                                <div style="width:6px;height:6px;border-radius:50%;background:#60a5fa;"></div>
                                                {{ $complaint->category->name ?? 'N/A' }}
                                            </span>
                                            <span style="font-size:12px;color:rgba(255,255,255,0.35);font-family:monospace">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        </div>
                                    </td>
                                    <td style="padding:14px 16px;vertical-align:top;">
                                        <div style="display:flex;align-items:center;gap:12px;">
                                            @if($complaint->is_anonymous)
                                                <div style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.06);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:rgba(255,255,255,0.55);">?</div>
                                                <div style="font-size:14px;color:rgba(255,255,255,0.55);font-style:italic">Anonymous</div>
                                            @else
                                                <div style="width:36px;height:36px;border-radius:50%;background:rgba(59,130,246,0.12);display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:600;color:#93c5fd">{{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}</div>
                                                <div style="font-size:14px;color:#e8f4ff">{{ $complaint->user->name ?? 'Unknown' }}</div>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="padding:14px 16px;vertical-align:top;">
                                        <div style="display:flex;flex-direction:column;gap:6px;align-items:flex-start;">
                                            <span style="display:inline-flex;align-items:center;border-radius:20px;padding:3px 12px;font-size:12px;font-weight:600;" class="{{ $complaint->status === 'Pending' ? 'status-pending' : ($complaint->status === 'In Progress' ? 'status-inprogress' : ($complaint->status === 'Resolved' ? 'status-resolved' : 'status-closed')) }}">
                                                @if($complaint->status === 'Pending')PENDING
                                                @elseif($complaint->status === 'In Progress')IN PROGRESS
                                                @elseif($complaint->status === 'Resolved')RESOLVED
                                                @else {{ strtoupper($complaint->status) }}
                                                @endif
                                            </span>
                                            @if($complaint->is_escalated)
                                                <span style="display:inline-flex;align-items:center;gap:4px;padding:2px 8px;border-radius:4px;font-size:10px;font-weight:800;letter-spacing:0.06em;background:rgba(239,68,68,0.12);color:#f87171;border:1px solid rgba(239,68,68,0.25);">
                                                    <span style="width:4px;height:4px;border-radius:50%;background:#f87171;animation:pulse 1.5s infinite;"></span>
                                                    ESCALATED
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                    <td style="padding:14px 16px;vertical-align:top;color:rgba(255,255,255,0.3);font-size:12px">{{ $complaint->created_at->format('M d, Y') }}</td>
                                    <td style="padding:14px 16px;vertical-align:top;text-align:right;">
                                        <a href="{{ route('admin.complaints.show', $complaint->id) }}" style="background:transparent;border:1px solid rgba(255,255,255,0.18);color:rgba(255,255,255,0.65);border-radius:6px;padding:5px 14px;font-size:12px;">Manage</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>