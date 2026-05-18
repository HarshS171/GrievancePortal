<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Rate Your Experience</h2>
                <p class="mt-1 text-sm text-gray-500">Share your feedback for complaint <span class="font-mono font-bold text-indigo-600">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span></p>
            </div>
            <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-secondary inline-flex">
                &larr; Back to Complaint
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <!-- Resolved Complaint Reference -->
            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4 mb-6 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-indigo-900">{{ $complaint->title }}</p>
                    <p class="text-xs text-indigo-600 mt-0.5">Resolved by administration &mdash; {{ $complaint->category->name ?? '' }}</p>
                </div>
            </div>

            <!-- Feedback Form Card -->
            <div class="card bg-white p-8 shadow-sm">
                <h3 class="text-lg font-bold text-gray-900 mb-6 text-center">How was your experience?</h3>

                <form action="{{ route('feedback.store', $complaint) }}" method="POST" class="space-y-8" id="feedback-form">
                    @csrf

                    <!-- Star Rating -->
                    <div class="text-center">
                        <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider mb-4">Your Rating</label>
                        <div class="flex justify-center items-center gap-2" x-data="{ rating: {{ old('rating', 0) }} }">
                            @for($i = 1; $i <= 5; $i++)
                                <button
                                    type="button"
                                    x-on:click="rating = {{ $i }}"
                                    x-bind:class="rating >= {{ $i }} ? 'text-amber-400 scale-110' : 'text-gray-300 hover:text-amber-300'"
                                    class="transition-all duration-150 focus:outline-none transform"
                                >
                                    <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                            <input type="hidden" name="rating" x-bind:value="rating">
                        </div>
                        <p class="mt-3 text-sm font-medium" x-data="{ rating: {{ old('rating', 0) }} }" x-bind:class="rating === 0 ? 'text-gray-400' : 'text-amber-600'">
                            <span x-show="rating === 0">Click a star to rate</span>
                            <span x-show="rating === 1">😞 Poor</span>
                            <span x-show="rating === 2">😐 Below Average</span>
                            <span x-show="rating === 3">🙂 Average</span>
                            <span x-show="rating === 4">😊 Good</span>
                            <span x-show="rating === 5">🤩 Excellent!</span>
                        </p>
                        @error('rating')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Comment -->
                    <div>
                        <label for="comment" class="form-label">Your Comment</label>
                        <textarea
                            name="comment"
                            id="comment"
                            rows="5"
                            class="form-input"
                            placeholder="Tell us about your experience. Was the issue resolved satisfactorily? How was the response time?..."
                            required
                        >{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="flex gap-4 justify-end pt-4 border-t border-gray-100">
                        <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary px-8">
                            Submit Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Sync two x-data instances for rating (simple approach)
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('#feedback-form button[type=button]');
            const ratingInput = document.querySelector('input[name=rating]');
            const labels = ['', '😞 Poor', '😐 Below Average', '🙂 Average', '😊 Good', '🤩 Excellent!'];
            const labelEl = document.querySelector('#feedback-form p[class*="text-sm font-medium"]');

            stars.forEach((star, i) => {
                star.addEventListener('click', () => {
                    const val = i + 1;
                    ratingInput.value = val;
                    stars.forEach((s, j) => {
                        if (j < val) {
                            s.classList.add('text-amber-400', 'scale-110');
                            s.classList.remove('text-gray-300', 'hover:text-amber-300');
                        } else {
                            s.classList.remove('text-amber-400', 'scale-110');
                            s.classList.add('text-gray-300', 'hover:text-amber-300');
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>