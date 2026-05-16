<section>
    <header style="margin-bottom: 20px;">
        <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 4px;">Profile Information</h3>
        <p class="text-sm text-muted mb-0">Update your account's profile information and email address.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div style="margin-top: 8px;">
                    <p class="text-sm">
                        Your email address is unverified.
                        <button form="send-verification" class="text-link text-sm" style="background: none; border: none; cursor: pointer;">Click here to re-send the verification email.</button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="text-sm" style="color: var(--success); margin-top: 8px;">A new verification link has been sent to your email address.</p>
                    @endif
                </div>
            @endif
        </div>

        <div class="form-actions">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-muted">Saved.</p>
            @endif
        </div>
    </form>
</section>
