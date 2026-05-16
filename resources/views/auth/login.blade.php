<x-guest-layout>
    <h2 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 24px;">Log in to your account</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password">
            @error('password') <p class="form-error">{{ $message }}</p> @enderror
        </div>

        <div class="form-group" style="display: flex; align-items: center; gap: 8px;">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me" class="text-sm text-muted" style="margin: 0;">Remember me</label>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">Log in</button>

        <div style="text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--border);">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-link text-sm" style="display: block; margin-bottom: 8px;">Forgot your password?</a>
            @endif
            <span class="text-sm text-muted">Don't have an account?</span>
            <a href="{{ route('register') }}" class="text-link text-sm" style="margin-left: 4px;">Sign up</a>
        </div>
    </form>
</x-guest-layout>
