<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 style="margin-bottom: 0;">{{ __('Complaint Details') }} #{{ $complaint->id }}</h2>
            <a href="{{ route('complaints.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
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
                                    <span style="background: var(--background); padding: 2px 8px; border-radius: 4px;">{{ $complaint->category->name }}</span>
                                    <span>•</span>
                                    <span>Submitted on {{ $complaint->created_at->format('M d, Y') }}</span>
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
                                <h4 style="font-size: 0.875rem; margin-bottom: 12px;">Attached Image:</h4>
                                <img src="{{ asset('storage/' . $complaint->image) }}" style="max-width: 100%; border-radius: var(--radius-lg); box-shadow: var(--shadow-md);">
                            </div>
                        @endif
                    </div>

                    @if($complaint->admin_remark)
                        <div class="card" style="background: #f0f7ff; border-color: #bee3f8;">
                            <h3 style="color: #2b6cb0; margin-bottom: 12px; display: flex; align-items: center; gap: 8px;">
                                <svg style="width: 20px; height: 20px;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                Official Response
                            </h3>
                            <p style="color: #2c5282; margin-bottom: 0; white-space: pre-line;">{{ $complaint->admin_remark }}</p>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div style="display: flex; flex-direction: column; gap: 24px;">
                    <div class="card">
                        <h3 style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 16px;">Grievance Info</h3>
                        <div style="display: flex; flex-direction: column; gap: 16px;">
                            <div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Current Status</div>
                                <div style="font-weight: 700; color: {{ $complaint->status == 'Resolved' ? 'var(--success)' : ($complaint->status == 'Rejected' ? 'var(--danger)' : 'var(--warning)') }}">
                                    {{ $complaint->status }}
                                </div>
                            </div>
                            <div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Reference ID</div>
                                <div style="font-family: monospace; font-weight: 600;">#GRV-{{ str_pad($complaint->id, 6, '0', STR_PAD_LEFT) }}</div>
                            </div>
                            <div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Last Updated</div>
                                <div>{{ $complaint->updated_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    </div>

                    @if($complaint->status == 'Resolved' && !$complaint->feedback)
                        <div class="card" style="background: var(--success); color: white; border: none; text-align: center;">
                            <h3 style="margin-bottom: 8px;">Resolution Complete</h3>
                            <p style="font-size: 0.875rem; margin-bottom: 16px; opacity: 0.9;">How was your experience? Your feedback helps us improve.</p>
                            <a href="{{ route('feedback.create', $complaint->id) }}" class="btn" style="background: white; color: var(--success); width: 100%;">
                                Share Feedback
                            </a>
                        </div>
                    @endif

                    @if($complaint->status == 'Pending')
                        <div style="display: flex; gap: 12px;">
                            <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-primary" style="flex: 1;">Edit</a>
                            <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" onsubmit="return confirm('Delete this?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary" style="color: var(--danger); border-color: #fed7d7;">Delete</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
