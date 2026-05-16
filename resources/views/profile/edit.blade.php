<x-app-layout>
    <x-slot name="header">
        <h2>Profile Settings</h2>
    </x-slot>

    <div class="section">
        <div class="container-narrow" style="display: flex; flex-direction: column; gap: 24px;">
            <div class="card">
                @include('profile.partials.update-profile-information-form')
            </div>
            <div class="card">
                @include('profile.partials.update-password-form')
            </div>
            <div class="card">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
