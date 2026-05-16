<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="margin-bottom: 0;">{{ __('Manage All Complaints') }}</h2>
                <p style="color: var(--text-muted); font-size: 0.875rem;">Total of {{ $complaints->count() }} records found.</p>
            </div>
            <div style="display: flex; gap: 12px;">
                <button class="btn btn-secondary" style="font-size: 0.75rem;">
                    <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter
                </button>
            </div>
        </div>
    </x-slot>

    <div class="section-py">
        <div class="container">
            <!-- Search Bar -->
            <div class="card glass" style="margin-bottom: 32px; padding: 16px;">
                <form action="{{ route('admin.complaints') }}" method="GET" style="display: flex; gap: 12px;">
                    <div style="position: relative; flex: 1;">
                        <svg style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 18px; height: 18px; color: var(--text-muted);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by complaint title or ID..." class="input" style="padding-left: 44px; background: white;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding: 0 24px;">
                        Search
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.complaints') }}" class="btn btn-secondary">Clear</a>
                    @endif
                </form>
            </div>

            @if($complaints->isEmpty())
                <div class="card" style="text-align: center; padding: 80px 40px; background: white;">
                    <div style="width: 80px; height: 80px; background: var(--background); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--border); margin: 0 auto 24px;">
                        <svg style="width: 40px; height: 40px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 style="color: var(--text-main); margin-bottom: 8px;">No Complaints Found</h3>
                    <p style="color: var(--text-muted); margin-bottom: 0;">Adjust your search or check back later for new submissions.</p>
                </div>
            @else
                <div class="card" style="padding: 0; overflow: hidden; border: none; box-shadow: var(--shadow-lg);">
                    <div class="table-container" style="border: none;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Grievance Details</th>
                                    <th>Citizen</th>
                                    <th>Current Status</th>
                                    <th>Submitted On</th>
                                    <th style="text-align: right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($complaints as $complaint)
                                    <tr>
                                        <td>
                                            <div style="font-weight: 800; color: var(--text-main); font-size: 1rem;">{{ $complaint->title }}</div>
                                            <div style="display: flex; align-items: center; gap: 6px; margin-top: 4px;">
                                                <span style="font-size: 0.75rem; color: var(--primary); font-weight: 700; background: rgba(99, 102, 241, 0.1); padding: 2px 6px; border-radius: 4px;">{{ $complaint->category->name }}</span>
                                                <span style="font-size: 0.75rem; color: var(--text-muted);">ID: #{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="display: flex; align-items: center; gap: 10px;">
                                                <div style="width: 32px; height: 32px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: 800; color: var(--secondary);">
                                                    {{ strtoupper(substr($complaint->user->name, 0, 1)) }}
                                                </div>
                                                <span style="font-weight: 600;">{{ $complaint->user->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $complaint->status == 'Resolved' ? 'badge-resolved' : ($complaint->status == 'Rejected' ? 'badge-rejected' : 'badge-pending') }}">
                                                {{ $complaint->status }}
                                            </span>
                                        </td>
                                        <td style="color: var(--text-muted); font-size: 0.875rem;">
                                            {{ $complaint->created_at->toFormattedDateString() }}
                                        </td>
                                        <td>
                                            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                                                <a href="{{ route('admin.complaints.show', $complaint->id) }}" class="btn btn-secondary" style="padding: 8px 16px; font-size: 0.75rem;">
                                                    Manage
                                                </a>
                                            </div>
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