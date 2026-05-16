<x-app-layout>
    <x-slot name="header">
        <h2 style="margin-bottom: 0;">{{ __('Manage Complaint') }} #{{ $complaint->id }}</h2>
    </x-slot>

    <div class="section-py">
        <div class="container">
            <div class="grid grid-cols-1" style="grid-template-columns: 2fr 1fr; gap: 32px;">
                <!-- Main Content -->
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <div class="card">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
                            <div>
                                <h1 style="font-size: 1.75rem; margin-bottom: 8px;">{{ $complaint->title }}</h1>
                                <div style="display: flex; gap: 12px; align-items: center; color: var(--text-muted); font-size: 0.875rem;">
                                    <span><strong>Citizen:</strong> {{ $complaint->user->name }}</span>
                                    <span>•</span>
                                    <span><strong>Category:</strong> {{ $complaint->category->name }}</span>
                                    <span>•</span>
                                    <span>{{ $complaint->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                            <span class="badge {{ $complaint->status == 'Resolved' ? 'badge-resolved' : ($complaint->status == 'Rejected' ? 'badge-rejected' : 'badge-pending') }}">
                                {{ $complaint->status }}
                            </span>
                        </div>

                        <div style="color: var(--text-main); font-size: 1rem; line-height: 1.6; margin-bottom: 32px; white-space: pre-line;">
                            {{ $complaint->description }}
                        </div>

                        @if($complaint->image)
                            <div style="padding-top: 24px; border-top: 1px solid var(--border);">
                                <h4 style="font-size: 0.875rem; margin-bottom: 12px;">Attachment:</h4>
                                <a href="{{ asset('storage/' . $complaint->image) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $complaint->image) }}" style="max-width: 100%; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                                </a>
                            </div>
                        @endif
                    </div>

                    @if($complaint->feedback)
                        <div class="card" style="background: #f0fdf4; border-color: #bbf7d0;">
                            <h3 style="color: #166534; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                Citizen Feedback
                            </h3>
                            <div style="font-weight: 700; color: #166534; margin-bottom: 8px;">Rating: {{ $complaint->feedback->rating }}/5</div>
                            <p style="color: #166534; margin-bottom: 0; font-style: italic;">"{{ $complaint->feedback->comment }}"</p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <div class="card">
                        <h3 style="margin-bottom: 16px;">Update Status</h3>
                        <form action="{{ route('admin.complaints.update', $complaint->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="label">Status</label>
                                <select name="status" class="select">
                                    <option value="Pending" {{ $complaint->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="In Progress" {{ $complaint->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="Resolved" {{ $complaint->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="Rejected" {{ $complaint->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="label">Admin Remark</label>
                                <textarea name="admin_remark" rows="4" class="textarea" placeholder="Action taken details...">{{ old('admin_remark', $complaint->admin_remark) }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary" style="width: 100%;">
                                Update Complaint
                            </button>
                        </form>
                    </div>

                    <div class="card" style="border-color: #fee2e2;">
                        <h3 style="color: var(--danger); font-size: 0.75rem; text-transform: uppercase; margin-bottom: 16px;">Danger Zone</h3>
                        <form action="{{ route('admin.complaints.destroy', $complaint->id) }}" method="POST" onsubmit="return confirm('Permanently delete?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="width: 100%;">
                                Delete Complaint
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>