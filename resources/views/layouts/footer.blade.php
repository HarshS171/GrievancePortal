<footer class="mt-auto border-t border-slate-700/70 bg-slate-950/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-slate-300">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <x-portal-logo size="sm" :href="auth()->check() ? route('dashboard') : url('/')" />
            <div class="flex flex-wrap gap-6 text-sm font-medium text-slate-500">
                <a href="{{ url('/') }}" class="hover:text-portal-800 transition-colors">Home</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-portal-800 transition-colors">Dashboard</a>
                    @if(auth()->user()->role === 'user')
                        <a href="{{ route('complaints.index') }}" class="hover:text-portal-800 transition-colors">My Complaints</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="hover:text-portal-800 transition-colors">Sign In</a>
                    <a href="{{ route('register') }}" class="hover:text-portal-800 transition-colors">Register</a>
                @endauth
            </div>
        </div>
        <div class="mt-6 pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-sm text-slate-500">
            <p>&copy; {{ date('Y') }} Citizen Grievance Redressal System. All rights reserved.</p>
            <p class="flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Secure government portal
            </p>
        </div>
    </div>
</footer>
