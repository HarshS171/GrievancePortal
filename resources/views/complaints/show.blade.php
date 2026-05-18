<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl font-bold text-gray-900">Complaint Details</h2>
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
                <p class="mt-1 text-sm text-gray-500">Submitted on {{ $complaint->created_at->format('F d, Y h:i A') }}</p>
            </div>
            <a href="{{ route('complaints.index') }}" class="btn btn-secondary inline-flex">
                &larr; Back to History
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Main Content Card -->
            <div class="card bg-white p-0 overflow-hidden shadow-sm">
                <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">{{ $complaint->title }}</h3>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-semibold bg-white border border-gray-200 text-gray-600">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        {{ $complaint->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
                <div class="p-6">
                    <div class="prose max-w-none text-gray-700">
                        <p class="whitespace-pre-line leading-relaxed">{{ $complaint->description }}</p>
                    </div>
                </div>
            </div>

            <!-- Address and Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Location details -->
                <div class="card bg-white shadow-sm p-6">
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Location Information</h4>
                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-500 font-medium">Block:</dt>
                            <dd class="text-gray-900">{{ $complaint->block ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 font-medium">Floor:</dt>
                            <dd class="text-gray-900">{{ $complaint->floor ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 font-medium">Room Number:</dt>
                            <dd class="text-gray-900">{{ $complaint->room_number ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex flex-col mt-2 pt-2 border-t border-gray-50">
                            <dt class="text-gray-500 font-medium">Area / Landmark:</dt>
                            <dd class="text-gray-900 mt-1">{{ $complaint->area_location ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Contact details -->
                <div class="card bg-white shadow-sm p-6">
                    <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Contact & Visit Details</h4>
                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-500 font-medium">Contact No:</dt>
                            <dd class="text-gray-900">{{ $complaint->contact_number ?? 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 font-medium">Availability Date:</dt>
                            <dd class="text-gray-900">{{ $complaint->availability_date ? \Carbon\Carbon::parse($complaint->availability_date)->format('M d, Y') : 'N/A' }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500 font-medium">Preferred Time:</dt>
                            <dd class="text-gray-900">{{ $complaint->preferred_time_slot ?? 'N/A' }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Image Attachment (if exists) -->
            @if($complaint->image)
            <div class="card bg-white shadow-sm">
                <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Attachment</h4>
                <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex justify-center">
                    <img src="{{ asset('storage/' . $complaint->image) }}" alt="Complaint Attachment" class="max-w-full h-auto object-contain max-h-[500px]">
                </div>
            </div>
            @endif

            <!-- Admin Response Block -->
            @if($complaint->admin_remark)
            <div class="rounded-xl p-6 bg-indigo-50 border border-indigo-100 shadow-sm">
                <div class="flex items-start gap-4">
                    <div class="shrink-0">
                        <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-sm font-bold text-indigo-900 uppercase tracking-wider mb-1">Official Remark / Resolution</h4>
                        <p class="text-indigo-800 whitespace-pre-line leading-relaxed">{{ $complaint->admin_remark }}</p>
                        <p class="mt-2 text-xs text-indigo-500 font-medium">Updated by Administration</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Feedback Section for Resolved Complaints -->
            @if($complaint->status === 'Resolved')
                @if($complaint->feedback)
                    <!-- Already submitted feedback -->
                    <div class="rounded-xl p-6 bg-amber-50 border border-amber-100 shadow-sm">
                        <div class="flex items-start gap-4">
                            <div class="shrink-0">
                                <div class="w-10 h-10 rounded-full bg-amber-400 flex items-center justify-center text-white">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-sm font-bold text-amber-900 uppercase tracking-wider">Your Feedback</h4>
                                    <div class="flex items-center gap-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5 {{ $i <= $complaint->feedback->rating ? 'text-amber-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                        <span class="ml-1 text-sm font-bold text-amber-700">{{ $complaint->feedback->rating }}/5</span>
                                    </div>
                                </div>
                                <p class="text-amber-800 leading-relaxed">{{ $complaint->feedback->comment }}</p>
                                <p class="mt-2 text-xs text-amber-500">Submitted {{ $complaint->feedback->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Prompt to give feedback -->
                    <div class="rounded-xl p-6 bg-green-50 border border-green-100 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/></svg>
                            </div>
                            <div>
                                <p class="font-bold text-green-900">Your complaint has been resolved!</p>
                                <p class="text-sm text-green-700 mt-0.5">Please take a moment to rate our service and share your experience.</p>
                            </div>
                        </div>
                        <a href="{{ route('feedback.create', $complaint) }}" class="btn btn-primary bg-green-600 hover:bg-green-700 whitespace-nowrap shrink-0">
                            ⭐ Rate & Give Feedback
                        </a>
                    </div>
                @endif
            @endif

            <!-- Actions (Delete) Only if pending -->
            @if($complaint->status === 'Pending')
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <form action="{{ route('complaints.destroy', $complaint) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this complaint?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Complaint</button>
                </form>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
