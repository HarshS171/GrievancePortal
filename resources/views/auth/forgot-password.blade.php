<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Reset Password</h2>
        <p class="mt-2 text-sm text-slate-500 font-medium">Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 rounded-lg bg-emerald-50 text-emerald-700 font-medium border border-emerald-100" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors" for="email">Email address</label>
            <input id="email" class="form-input w-full @error('email') border-rose-300 ring-rose-200 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
            @error('email') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-full py-2.5 text-base mt-2 shadow-lg shadow-portal-200">
            Email Password Reset Link
        </button>

        <div class="pt-6 mt-6 border-t border-slate-100 text-center">
            <a href="{{ route('login') }}" class="text-portal-700 font-bold hover:text-portal-600 transition-colors text-sm flex items-center justify-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to sign in
            </a>
        </div>
    </form>
</x-guest-layout>
