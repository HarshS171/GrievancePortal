<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Create your account</h2>
        <p class="mt-2 text-sm text-slate-500 font-medium">Join us to start submitting your grievances easily.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf
        
        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors" for="name">Full Name</label>
            <input id="name" class="form-input w-full @error('name') border-rose-300 ring-rose-200 @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
            @error('name') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors" for="email">Email address</label>
            <input id="email" class="form-input w-full @error('email') border-rose-300 ring-rose-200 @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com">
            @error('email') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors" for="password">Password</label>
            <input id="password" class="form-input w-full @error('password') border-rose-300 ring-rose-200 @enderror" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
            @error('password') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-portal-700 transition-colors" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="form-input w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
        </div>

        <button type="submit" class="btn btn-primary w-full py-2.5 text-base mt-2 shadow-lg shadow-portal-200">
            Create Account
        </button>

        <div class="pt-6 mt-6 border-t border-slate-100 text-center">
            <p class="text-sm text-slate-600 font-medium">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-portal-700 font-bold hover:text-portal-600 transition-colors ml-1">Sign in instead</a>
            </p>
        </div>
    </form>
</x-guest-layout>
