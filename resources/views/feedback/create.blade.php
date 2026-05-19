<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 animate-fade-in">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Rate Your Experience</h2>
                <p class="mt-2 text-sm text-slate-500 font-medium">Share your feedback for complaint <span class="font-bold text-portal-700 px-2 py-0.5 bg-portal-50 rounded-md border border-portal-100">#{{ str_pad($complaint->id, 5, '0', STR_PAD_LEFT) }}</span></p>
            </div>
            <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-secondary inline-flex items-center gap-2 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Complaint
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 animate-slide-up">

            <!-- Resolved Complaint Reference -->
            <div class="bg-portal-50 border border-portal-100/60 rounded-2xl p-6 mb-8 flex items-center gap-5 shadow-sm">
                <div class="w-12 h-12 rounded-full bg-portal-700 flex items-center justify-center text-white shrink-0 shadow-md shadow-portal-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-base font-extrabold text-portal-950">{{ $complaint->title }}</p>
                    <p class="text-sm font-medium text-portal-700/80 mt-1">Resolved by administration &bull; {{ $complaint->category->name ?? '' }}</p>
                </div>
            </div>

            <!-- Feedback Form Card -->
            <div class="card bg-white p-8 sm:p-12 shadow-lg shadow-slate-200/40 border-0 ring-1 ring-slate-100">
                <div class="text-center mb-10">
                    <h3 class="text-2xl font-extrabold text-slate-900 tracking-tight">How was your experience?</h3>
                    <p class="text-slate-500 font-medium mt-2">Your feedback helps us improve our services.</p>
                </div>

                <form action="{{ route('feedback.store', $complaint) }}" method="POST" class="space-y-10" id="feedback-form">
                    @csrf

                    <!-- Star Rating -->
                    <div class="text-center">
                        <label class="block text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-6">Your Rating</label>
                        <div class="flex justify-center items-center gap-3">
                            @for($i = 1; $i <= 5; $i++)
                                <button
                                    type="button"
                                    data-rating="{{ $i }}"
                                    class="star-btn transition-all duration-300 focus:outline-none transform hover:scale-110 {{ old('rating', 0) >= $i ? 'text-amber-400 scale-110 drop-shadow-md' : 'text-slate-200 hover:text-amber-300' }}"
                                >
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </button>
                            @endfor
                            <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', 0) }}">
                        </div>
                        <div class="h-8 mt-4 flex items-center justify-center">
                            <p id="rating-label" class="text-base font-bold transition-colors {{ old('rating', 0) > 0 ? 'text-amber-600' : 'text-slate-400' }}">
                                @php
                                    $oldRating = old('rating', 0);
                                    if($oldRating == 1) echo '😞 Poor';
                                    elseif($oldRating == 2) echo '😐 Below Average';
                                    elseif($oldRating == 3) echo '🙂 Average';
                                    elseif($oldRating == 4) echo '😊 Good';
                                    elseif($oldRating == 5) echo '🤩 Excellent!';
                                    else echo 'Click a star to rate';
                                @endphp
                            </p>
                        </div>
                        @error('rating')
                            <p class="mt-2 text-sm font-medium text-rose-500 flex items-center justify-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Comment -->
                    <div class="group">
                        <label for="comment" class="block text-sm font-semibold text-slate-700 mb-2 group-focus-within:text-portal-700 transition-colors">Your Comment</label>
                        <textarea
                            name="comment"
                            id="comment"
                            rows="5"
                            class="form-input w-full resize-y @error('comment') border-rose-300 ring-rose-200 @enderror"
                            placeholder="Tell us about your experience. Was the issue resolved satisfactorily? How was the response time?..."
                            required
                        >{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="flex flex-col-reverse sm:flex-row gap-4 justify-end pt-8 border-t border-slate-100">
                        <a href="{{ route('complaints.show', $complaint) }}" class="btn btn-secondary text-center">Cancel</a>
                        <button type="submit" class="btn btn-primary px-8 py-3 shadow-lg shadow-portal-200 text-base">
                            Submit Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star-btn');
            const ratingInput = document.getElementById('rating-input');
            const labelEl = document.getElementById('rating-label');
            const labels = ['', '😞 Poor', '😐 Below Average', '🙂 Average', '😊 Good', '🤩 Excellent!'];

            stars.forEach((star) => {
                star.addEventListener('click', () => {
                    const val = parseInt(star.getAttribute('data-rating'));
                    ratingInput.value = val;
                    
                    labelEl.textContent = labels[val];
                    labelEl.classList.remove('text-slate-400');
                    labelEl.classList.add('text-amber-600');

                    stars.forEach((s) => {
                        const sVal = parseInt(s.getAttribute('data-rating'));
                        if (sVal <= val) {
                            s.classList.add('text-amber-400', 'scale-110', 'drop-shadow-md');
                            s.classList.remove('text-slate-200', 'hover:text-amber-300');
                        } else {
                            s.classList.remove('text-amber-400', 'scale-110', 'drop-shadow-md');
                            s.classList.add('text-slate-200', 'hover:text-amber-300');
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>