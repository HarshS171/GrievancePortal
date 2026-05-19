<x-guest-layout>
    <div class="mb-8 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-portal-50 text-portal-700 mb-6 shadow-sm border border-portal-100/50">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
        </div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Check your email</h2>
        <p class="mt-3 text-sm text-slate-500 font-medium leading-relaxed">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-8 p-4 rounded-xl bg-emerald-50 text-emerald-700 font-semibold border border-emerald-100 flex items-start gap-3 shadow-sm">
            <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-sm text-left">A new verification link has been sent to the email address you provided during registration.</p>
        </div>
    @endif

    <div class="flex flex-col gap-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary w-full py-2.5 shadow-lg shadow-portal-200 text-base">
                Resend Verification Email
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-sm font-bold text-slate-500 hover:text-slate-900 transition-colors py-2 px-4 rounded-lg hover:bg-slate-50">
                Log Out
            </button>
        </form>
    </div>
</x-guest-layout>
