<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Create your account</h2>
        <p class="mt-2 text-sm text-slate-500 font-medium">Join the grievance portal and start submitting requests in under a minute.</p>
    </div>

    <div class="bg-white/95 border border-slate-200 shadow-portal-lg rounded-[32px] p-8 sm:p-10">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div class="group">
                <label class="form-label" for="name">Full Name</label>
                <input id="name" class="form-input w-full @error('name') border-rose-300 ring-rose-200 @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="John Doe">
                @error('name')
                    <p class="mt-2 text-sm font-medium text-rose-500 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="group">
                <label class="form-label" for="email">Email address</label>
                <input id="email" class="form-input w-full @error('email') border-rose-300 ring-rose-200 @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="you@example.com">
                @error('email')
                    <p class="mt-2 text-sm font-medium text-rose-500 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="group">
                    <label class="form-label" for="password">Password</label>
                    <input id="password" class="form-input w-full @error('password') border-rose-300 ring-rose-200 @enderror" type="password" name="password" required autocomplete="new-password" placeholder="Create a strong password">
                    @error('password')
                        <p class="mt-2 text-sm font-medium text-rose-500 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="group">
                    <label class="form-label" for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" class="form-input w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-full py-3 text-base shadow-lg shadow-portal-200">
                Create Account
            </button>

            <div class="pt-6 mt-6 border-t border-slate-100 text-center">
                <p class="text-sm text-slate-600 font-medium">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-portal-700 font-bold hover:text-portal-600 transition-colors">Sign in instead</a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>
