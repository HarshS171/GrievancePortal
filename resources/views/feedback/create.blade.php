<x-app-layout>
    <x-slot name="header">
        <h2 style="margin-bottom: 0;">{{ __('Give Feedback') }}</h2>
    </x-slot>

    <div class="section-py">
        <div class="container" style="max-width: 600px;">
            <div class="card">
                <div style="margin-bottom: 24px;">
                    <h3 style="margin-bottom: 4px;">{{ $complaint->title }}</h3>
                    <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 0;">Your feedback helps us improve our services.</p>
                </div>

                <form action="{{ route('feedback.store', $complaint->id) }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label class="label">Rating</label>
                        <select name="rating" class="select" required>
                            <option value="" disabled selected>Rate your experience (1-5)</option>
                            <option value="5">5 - Excellent</option>
                            <option value="4">4 - Good</option>
                            <option value="3">3 - Satisfactory</option>
                            <option value="2">2 - Poor</option>
                            <option value="1">1 - Very Poor</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label">Comment</label>
                        <textarea name="comment" rows="4" class="textarea" required placeholder="Tell us more about your experience...">{{ old('comment') }}</textarea>
                    </div>

                    <div style="margin-top: 32px; display: flex; align-items: center; gap: 16px;">
                        <button type="submit" class="btn btn-primary">
                            Submit Feedback
                        </button>
                        <a href="{{ route('complaints.index') }}" style="font-size: 0.875rem; color: var(--text-muted); text-decoration: none;">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>