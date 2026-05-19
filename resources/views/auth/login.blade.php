<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Welcome back</h2>
        <p class="mt-2 text-sm text-slate-500 font-medium">Please enter your details to sign in.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        
        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors" for="email">Email address</label>
            <input id="email" class="form-input w-full @error('email') border-rose-300 ring-rose-200 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Enter your email">
            @error('email') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <div class="group">
            <div class="flex items-center justify-between mb-1.5">
                <label class="block text-sm font-semibold text-slate-700 group-focus-within:text-portal-700 transition-colors" for="password">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm font-semibold text-portal-700 hover:text-portal-600 transition-colors">Forgot password?</a>
                @endif
            </div>
            <input id="password" class="form-input w-full @error('password') border-rose-300 ring-rose-200 @enderror" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
            @error('password') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-portal-700 focus:ring-portal-600 transition-colors cursor-pointer">
            <label for="remember_me" class="ml-2 text-sm font-medium text-slate-600 cursor-pointer select-none">Remember me for 30 days</label>
        </div>

        <button type="submit" class="btn btn-primary w-full py-2.5 text-base shadow-lg shadow-portal-200">
            Sign In
        </button>

        <div class="pt-6 mt-6 border-t border-slate-100 text-center">
            <p class="text-sm text-slate-600 font-medium">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-portal-700 font-bold hover:text-portal-600 transition-colors ml-1">Create an account</a>
            </p>
        </div>
    </form>
</x-guest-layout>
