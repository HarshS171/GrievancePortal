<section>
    <header style="margin-bottom: 20px;">
        <h3 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 4px;">Delete Account</h3>
        <p class="text-sm text-muted mb-0">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" style="padding: 32px;">
            @csrf
            @method('delete')

            <h2 style="font-size: 1.125rem; font-weight: 600; margin-bottom: 8px;">Are you sure you want to delete your account?</h2>
            <p class="text-sm text-muted" style="margin-bottom: 20px;">Once deleted, all data will be permanently removed. Please enter your password to confirm.</p>

            <div class="form-group">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                <x-secondary-button x-on:click="$dispatch('close')">Cancel</x-secondary-button>
                <x-danger-button>{{ __('Delete Account') }}</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
