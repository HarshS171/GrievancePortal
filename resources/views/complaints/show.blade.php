<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
            <div class="flex items-center gap-4">
                <a href="{{ route('complaints.index') }}" class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-900 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Complaint Details</h2>
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
                    <p class="mt-2 text-sm font-medium text-slate-500 flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Submitted on {{ $complaint->created_at->format('F d, Y \a\t h:i A') }}
                    </p>
                </div>
            </div>
            
            @if($complaint->status === 'Pending')
            <div class="flex items-center gap-3">
                <form action="{{ route('complaints.destroy', $complaint) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this complaint? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger bg-rose-50 text-rose-600 border-rose-200 hover:bg-rose-600 hover:text-white shadow-none hover:shadow-md hover:shadow-rose-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        Delete Complaint
                    </button>
                </form>
            </div>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6 animate-slide-up">

            <x-grievance-timeline :status="$complaint->status" />

            <!-- Main Content Card -->
            <div class="card bg-white p-0 overflow-hidden border-0 shadow-lg shadow-slate-200/50 ring-1 ring-slate-100">
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
                    <h3 class="text-2xl font-bold text-slate-900 leading-tight flex-grow">{{ $complaint->title }}</h3>
                    <div class="shrink-0">
                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg text-sm font-bold bg-portal-50 text-portal-700 border border-portal-100/60 shadow-sm shadow-portal-100/50">
                            <div class="w-5 h-5 rounded flex items-center justify-center bg-portal-100 text-portal-700">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                            {{ $complaint->category->name ?? 'Uncategorized' }}
                        </span>
                    </div>
                </div>
                <div class="p-8">
                    <div class="prose max-w-none">
                        <p class="whitespace-pre-line text-slate-700 leading-relaxed text-base">{{ $complaint->description }}</p>
                    </div>
                </div>
                @if($complaint->category && ($complaint->category->officer_name || $complaint->category->officer_phone))
                <div class="px-8 py-4 bg-portal-50/50 border-t border-portal-100 flex flex-col sm:flex-row gap-4 sm:gap-6 sm:items-center">
                    <span class="text-sm font-bold text-portal-900">Dealing Officer:</span>
                    @if($complaint->category->officer_name)
                    <div class="flex items-center gap-2 text-sm font-medium text-portal-700">
                        <svg class="w-4 h-4 text-portal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ $complaint->category->officer_name }}
                    </div>
                    @endif
                    @if($complaint->category->officer_phone)
                    <div class="flex items-center gap-2 text-sm font-medium text-portal-700">
                        <svg class="w-4 h-4 text-portal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        {{ $complaint->category->officer_phone }}
                    </div>
                    @endif
                </div>
                @endif
            </div>

            <!-- Address and Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Location details -->
                <div class="card bg-white shadow-sm p-8 border-slate-200/60 hover:border-blue-200 transition-colors group">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 tracking-tight">Location Information</h4>
                    </div>
                    <dl class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-slate-50">
                            <dt class="text-sm font-semibold text-slate-500">Block</dt>
                            <dd class="text-sm font-bold text-slate-900 bg-slate-50 px-2 py-1 rounded">{{ $complaint->block ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-50">
                            <dt class="text-sm font-semibold text-slate-500">Floor</dt>
                            <dd class="text-sm font-bold text-slate-900 bg-slate-50 px-2 py-1 rounded">{{ $complaint->floor ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-50">
                            <dt class="text-sm font-semibold text-slate-500">Room Number</dt>
                            <dd class="text-sm font-bold text-slate-900 bg-slate-50 px-2 py-1 rounded">{{ $complaint->room_number ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex flex-col pt-2">
                            <dt class="text-sm font-semibold text-slate-500 mb-1">Area / Landmark</dt>
                            <dd class="text-base font-bold text-slate-900">{{ $complaint->area_location ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Contact details -->
                <div class="card bg-white shadow-sm p-8 border-slate-200/60 hover:border-emerald-200 transition-colors group">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <h4 class="text-lg font-bold text-slate-900 tracking-tight">Contact & Visit Details</h4>
                    </div>
                    <dl class="space-y-4">
                        <div class="flex justify-between items-center py-2 border-b border-slate-50">
                            <dt class="text-sm font-semibold text-slate-500">Contact No</dt>
                            <dd class="text-sm font-bold text-slate-900">{{ $complaint->contact_number ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-slate-50">
                            <dt class="text-sm font-semibold text-slate-500">Availability Date</dt>
                            <dd class="text-sm font-bold text-slate-900 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ $complaint->availability_date ? \Carbon\Carbon::parse($complaint->availability_date)->format('M d, Y') : 'N/A' }}
                            </dd>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <dt class="text-sm font-semibold text-slate-500">Preferred Time</dt>
                            <dd class="text-sm font-bold text-slate-900 flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $complaint->preferred_time_slot ?? 'N/A' }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Image Attachment (if exists) -->
            @if($complaint->image)
            <div class="card bg-white shadow-sm p-8 border-slate-200/60">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-slate-50 text-slate-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <h4 class="text-lg font-bold text-slate-900 tracking-tight">Attached Media</h4>
                </div>
                <div class="rounded-xl overflow-hidden border-2 border-dashed border-slate-200 bg-slate-50 flex justify-center p-2 group hover:border-portal-400 transition-colors">
                    <a href="{{ asset('storage/' . $complaint->image) }}" target="_blank" class="relative block rounded-lg overflow-hidden w-full">
                        <img src="{{ asset('storage/' . $complaint->image) }}" alt="Complaint Attachment" class="w-full h-auto object-contain max-h-[600px] rounded-lg">
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="btn bg-white text-slate-900 shadow-xl pointer-events-none">View Full Screen</span>
                        </div>
                    </a>
                </div>
            </div>
            @endif

            <!-- Admin Response Block -->
            @if($complaint->admin_remark)
            <div class="rounded-2xl p-8 bg-gradient-to-br from-portal-50 to-blue-50 border border-portal-100/60 shadow-sm relative overflow-hidden">
                <div class="absolute right-0 top-0 w-32 h-32 bg-portal-600/5 rounded-bl-full -mr-10 -mt-10"></div>
                <div class="flex items-start gap-5 relative z-10">
                    <div class="shrink-0">
                        <div class="w-14 h-14 rounded-full bg-portal-700 flex items-center justify-center text-white shadow-lg shadow-portal-200">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <h4 class="text-lg font-extrabold text-portal-950 mb-2">Official Resolution & Remarks</h4>
                        <div class="bg-white/60 rounded-xl p-5 border border-portal-100 backdrop-blur-sm">
                            <p class="text-portal-900 whitespace-pre-line leading-relaxed text-base">{{ $complaint->admin_remark }}</p>
                        </div>
                        <div class="mt-3 flex items-center gap-2">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-portal-100 text-portal-700">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Authenticated
                            </span>
                            <p class="text-xs text-portal-600 font-medium">Updated by Administration</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Feedback Section for Resolved Complaints -->
            @if($complaint->status === 'Resolved')
                @if($complaint->feedback)
                    <!-- Already submitted feedback -->
                    <div class="rounded-2xl p-8 bg-amber-50/50 border border-amber-200/50 shadow-sm">
                        <div class="flex items-start gap-5">
                            <div class="shrink-0">
                                <div class="w-14 h-14 rounded-full bg-gradient-to-br from-amber-400 to-amber-500 flex items-center justify-center text-white shadow-lg shadow-amber-200">
                                    <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 gap-2">
                                    <h4 class="text-lg font-extrabold text-amber-950">Your Experience Feedback</h4>
                                    <div class="flex items-center gap-1 bg-white px-3 py-1.5 rounded-lg border border-amber-100 shadow-sm">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $complaint->feedback->rating ? 'text-amber-400' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                        <span class="ml-2 text-sm font-extrabold text-amber-600">{{ $complaint->feedback->rating }}.0</span>
                                    </div>
                                </div>
                                <div class="bg-white rounded-xl p-5 border border-amber-100 shadow-sm">
                                    <p class="text-amber-900 leading-relaxed italic">"{{ $complaint->feedback->comment }}"</p>
                                </div>
                                @if($complaint->feedback->work_image)
                                    <div class="mt-4 rounded-xl overflow-hidden border border-slate-200 bg-slate-50 shadow-sm">
                                        <img src="{{ asset('storage/' . $complaint->feedback->work_image) }}" alt="Work Image" class="w-full h-auto object-contain max-h-[420px]">
                                    </div>
                                @endif
                                <p class="mt-3 text-xs font-semibold text-amber-600/70">Submitted {{ $complaint->feedback->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Prompt to give feedback -->
                    <div class="rounded-2xl p-8 bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-100 shadow-md flex flex-col md:flex-row items-center justify-between gap-6 relative overflow-hidden">
                        <div class="absolute inset-0 bg-white/40 backdrop-blur-sm pointer-events-none"></div>
                        <div class="flex items-center gap-5 relative z-10 w-full md:w-auto">
                            <div class="w-16 h-16 shrink-0 rounded-2xl bg-gradient-to-br from-emerald-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-emerald-200 transform -rotate-6">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-extrabold text-emerald-950 mb-1">Issue Resolved Successfully!</h3>
                                <p class="text-sm font-medium text-emerald-800">Your feedback helps us maintain transparency and improve our services.</p>
                            </div>
                        </div>
                        <a href="{{ route('feedback.create', $complaint) }}" class="btn btn-primary bg-emerald-600 hover:bg-emerald-700 hover:shadow-emerald-300 w-full md:w-auto text-center justify-center shadow-lg shadow-emerald-200 relative z-10 py-3 px-8 text-base group">
                            <span class="group-hover:scale-110 transition-transform inline-block">⭐</span> Rate Your Experience
                        </a>
                    </div>
                @endif
            @endif

        </div>
    </div>
</x-app-layout>
