<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Welcome back</h2>
        <p class="mt-2 text-sm text-slate-500 font-medium">Sign in to manage grievances, track statuses, and stay informed.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="bg-white/95 border border-slate-200 shadow-portal-lg rounded-[32px] p-8 sm:p-10">
        <form method="POST" action="{{ route('login') }}" class="space-y-6" x-data="{ showPassword: false }">
            @csrf

            <div class="group">
                <label class="form-label" for="email">Email address</label>
                <input id="email" class="form-input w-full @error('email') border-rose-300 ring-rose-200 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="you@example.com">
                @error('email')
                    <p class="mt-2 text-sm font-medium text-rose-500 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="group">
                <div class="flex items-center justify-between mb-2">
                    <label class="form-label" for="password">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm font-semibold text-portal-700 hover:text-portal-600 transition-colors">Forgot password?</a>
                    @endif
                </div>
                <div class="relative">
                    <input id="password" class="form-input w-full pr-12 @error('password') border-rose-300 ring-rose-200 @enderror" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" placeholder="••••••••">
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-slate-700" @click="showPassword = !showPassword" tabindex="-1">
                        <span x-text="showPassword ? 'Hide' : 'Show'"></span>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm font-medium text-rose-500 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex items-center justify-between gap-4">
                <label class="inline-flex items-center gap-2 text-sm text-slate-600 cursor-pointer select-none">
                    <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-portal-700 focus:ring-portal-600" />
                    Remember me for 30 days
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-full py-3 text-base shadow-lg shadow-portal-200">
                Sign In
            </button>

            <div class="pt-6 mt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-600 font-medium">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-portal-700 font-bold hover:text-portal-600 transition-colors">Create one</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
