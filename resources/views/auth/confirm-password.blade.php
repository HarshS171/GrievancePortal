<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-amber-50 text-amber-600 mb-6 shadow-sm border border-amber-100/50">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Confirm Password</h2>
        <p class="mt-3 text-sm text-slate-500 font-medium leading-relaxed">This is a secure area of the application. Please confirm your password before continuing.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors" for="password">Password</label>
            <input id="password" class="form-input w-full @error('password') border-rose-300 ring-rose-200 @enderror" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            @error('password') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-full py-2.5 mt-2 shadow-lg shadow-portal-200 text-base">
            Confirm Password
        </button>
    </form>
</x-guest-layout>
