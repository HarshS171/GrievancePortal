<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <h2 class="text-2xl font-bold text-gray-900">Manage Complaint #{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</h2>
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
                <p class="mt-1 text-sm text-gray-500">Submitted by {{ $complaint->user->name }} on {{ $complaint->created_at->format('M d, Y h:i A') }}</p>
            </div>
            <a href="{{ route('admin.complaints') }}" class="btn btn-secondary inline-flex">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Left Column: Details -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="card bg-white p-0 overflow-hidden shadow-sm">
                        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-gray-900">{{ $complaint->title }}</h3>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-semibold bg-white border border-gray-200 text-gray-600">
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

                    @if($complaint->image)
                    <div class="card bg-white shadow-sm p-6">
                        <h4 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 pb-2 border-b border-gray-100">Attachment</h4>
                        <div class="rounded-lg overflow-hidden border border-gray-200 bg-gray-50 flex justify-center">
                            <img src="{{ asset('storage/' . $complaint->image) }}" alt="Complaint Attachment" class="max-w-full h-auto object-contain max-h-[400px]">
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column: Admin Actions -->
                <div class="space-y-6">
                    <!-- Update Status Card -->
                    <div class="card bg-white shadow-sm p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Update Status</h3>
                        <form action="{{ route('admin.complaints.update', $complaint) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            
                            <div>
                                <label for="status" class="form-label">Current Status</label>
                                <select name="status" id="status" class="form-input">
                                    <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ $complaint->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Resolved" {{ $complaint->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="Rejected" {{ $complaint->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <div>
                                <label for="admin_remark" class="form-label">Admin Remark (Optional)</label>
                                <textarea name="admin_remark" id="admin_remark" rows="4" class="form-input" placeholder="Enter resolution details or remarks sent to citizen...">{{ $complaint->admin_remark }}</textarea>
                                @error('admin_remark')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-full mt-2">
                                Save Changes
                            </button>
                        </form>
                    </div>

                    <!-- Delete Card -->
                    <div class="card bg-white border border-red-100 shadow-sm p-6">
                        <h3 class="text-lg font-bold text-red-600 mb-2">Danger Zone</h3>
                        <p class="text-sm text-gray-500 mb-4">Permanently delete this complaint from the system. This action cannot be undone.</p>
                        <form action="{{ route('admin.complaints.destroy', $complaint) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this complaint?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger w-full">
                                Delete Complaint
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>