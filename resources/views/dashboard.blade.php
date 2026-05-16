<x-app-layout>
    <x-slot name="header">
        <h2>Welcome back, {{ auth()->user()->name }}</h2>
        <p>Submit and track your grievances from here.</p>
    </x-slot>

    <div class="section">
        <div class="container">
            <div class="hero-banner" style="margin-bottom: 32px;">
                <h3>How can we help you today?</h3>
                <p>Our team is ready to assist you in resolving any issues regarding public services.</p>
                <div class="hero-actions">
                    <a href="{{ route('complaints.create') }}" class="hero-btn-white">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        File a New Complaint
                    </a>
                    <a href="{{ route('complaints.index') }}" class="hero-btn-outline">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        View My History
                    </a>
                </div>
            </div>

            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon" style="background: var(--primary-light); color: var(--primary);">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <h4>Easy Submission</h4>
                    <p>Fill out our form with descriptions and attachments in minutes.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background: var(--warning-light); color: var(--warning);">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h4>Live Tracking</h4>
                    <p>Monitor the real-time status of your complaint as it moves through processing.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background: var(--success-light); color: var(--success);">
                        <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h4>Direct Resolution</h4>
                    <p>Receive official feedback and confirmation once your grievance is resolved.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>