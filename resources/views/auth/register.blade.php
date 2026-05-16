<x-guest-layout>
    <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 24px;">Create your account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password">
            @error('password') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">Create Account</button>

        <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border);">
            <span class="text-sm text-muted">Already have an account?</span>
            <a href="{{ route('login') }}" class="text-link text-sm" style="margin-left: 4px;">Log in</a>
        </div>
    </form>
</x-guest-layout>
