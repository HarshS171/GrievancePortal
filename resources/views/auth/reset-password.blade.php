<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Set New Password</h2>
        <p class="mt-2 text-sm text-slate-500 font-medium">Please enter your new password below.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-indigo-600 transition-colors" for="email">Email address</label>
            <input id="email" class="form-input w-full @error('email') border-rose-300 ring-rose-200 @enderror" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
            @error('email') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-indigo-600 transition-colors" for="password">New Password</label>
            <input id="password" class="form-input w-full @error('password') border-rose-300 ring-rose-200 @enderror" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
            @error('password') <p class="mt-1.5 text-sm font-medium text-rose-500 flex items-center gap-1"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ $message }}</p> @enderror
        </div>

        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1.5 group-focus-within:text-indigo-600 transition-colors" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="form-input w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
        </div>

        <button type="submit" class="btn btn-primary w-full py-2.5 mt-2 shadow-lg shadow-indigo-200 text-base">
            Reset Password
        </button>
    </form>
</x-guest-layout>
