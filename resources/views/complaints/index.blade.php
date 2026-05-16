<x-app-layout>
    <x-slot name="header">
        <div class="page-header-row">
            <h2>My Complaints</h2>
            <a href="{{ route('complaints.create') }}" class="btn btn-primary btn-sm">+ New Complaint</a>
        </div>
    </x-slot>

    <div class="section">
        <div class="container">
            {{-- Search --}}
            <div class="card" style="margin-bottom: 24px; padding: 16px;">
                <form action="{{ route('complaints.index') }}" method="GET" style="display: flex; gap: 12px;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title or description..." class="form-input" style="flex: 1;">
                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    @if(request('search'))
                        <a href="{{ route('complaints.index') }}" class="btn btn-secondary btn-sm">Clear</a>
                    @endif
                </form>
            </div>

            @if($complaints->isEmpty())
                <div class="card empty-state">
                    <p>No complaints found. <a href="{{ route('complaints.create') }}" class="text-link">Submit one now.</a></p>
                </div>
            @else
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    @foreach($complaints as $complaint)
                        <div class="card" style="border-left: 3px solid {{ $complaint->status == 'Resolved' ? 'var(--success)' : ($complaint->status == 'Rejected' ? 'var(--danger)' : 'var(--warning)') }};">
                            <div class="complaint-item">
                                <div class="complaint-header">
                                    <div>
                                        <h3 style="font-size: 1rem; margin-bottom: 4px;">{{ $complaint->title }}</h3>
                                        <div class="complaint-meta">
                                            <span class="badge badge-muted">{{ $complaint->category->name }}</span>
                                            <span>&middot;</span>
                                            <span>{{ $complaint->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <span class="badge {{ $complaint->status == 'Resolved' ? 'badge-resolved' : ($complaint->status == 'Rejected' ? 'badge-rejected' : 'badge-pending') }}">{{ $complaint->status }}</span>
                                </div>

                                <p class="complaint-body">{{ Str::limit($complaint->description, 180) }}</p>

                                @if($complaint->image)
                                    <img src="{{ asset('storage/' . $complaint->image) }}" alt="Attachment" style="max-height: 140px; width: auto; border-radius: var(--radius); border: 1px solid var(--border);">
                                @endif

                                <div class="complaint-footer">
                                    <div class="complaint-actions">
                                        <a href="{{ route('complaints.show', $complaint->id) }}" class="action-link action-link-primary">View</a>
                                        <a href="{{ route('complaints.edit', $complaint->id) }}" class="action-link action-link-muted">Edit</a>
                                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" style="display: inline;">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="action-link action-link-danger">Delete</button>
                                        </form>
                                    </div>
                                    @if($complaint->status == 'Resolved' && !$complaint->feedback)
                                        <a href="{{ route('feedback.create', $complaint->id) }}" class="btn btn-primary btn-xs">Give Feedback</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>