@if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" x-transition class="mb-4 rounded-xl border border-emerald-200/80 bg-emerald-50/90 backdrop-blur-sm px-4 py-3.5 flex items-start gap-3 shadow-sm animate-slide-down" role="alert">
        <div class="w-9 h-9 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        </div>
        <div class="flex-grow pt-0.5">
            <p class="text-sm font-bold text-emerald-900">Success</p>
            <p class="text-sm font-medium text-emerald-800 mt-0.5">{{ session('success') }}</p>
        </div>
        <button type="button" @click="show = false" class="text-emerald-600 hover:text-emerald-800 p-1 rounded-lg hover:bg-emerald-100 transition-colors" aria-label="Dismiss">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
@endif

@if(session('error') || $errors->any())
    <div class="mb-4 rounded-xl border border-rose-200/80 bg-rose-50/90 backdrop-blur-sm px-4 py-3.5 flex items-start gap-3 shadow-sm animate-slide-down" role="alert">
        <div class="w-9 h-9 rounded-lg bg-rose-100 text-rose-700 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
        </div>
        <div class="flex-grow pt-0.5">
            <p class="text-sm font-bold text-rose-900">{{ session('error') ? 'Error' : 'Please fix the following' }}</p>
            @if(session('error'))
                <p class="text-sm font-medium text-rose-800 mt-0.5">{{ session('error') }}</p>
            @else
                <ul class="mt-1.5 space-y-1 text-sm font-medium text-rose-800 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endif
