<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Public Grievance Portal | Citizen Grievance Redressal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-white">

    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-xl border-b border-slate-200/80 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <x-portal-logo size="md" href="{{ url('/') }}" />
                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-ghost hidden sm:inline-flex">Sign In</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary shadow-portal">Get Started</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-28 pb-16 lg:pt-40 lg:pb-28 overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-b from-portal-50/80 via-white to-white"></div>
            <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-400/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-portal-400/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <div class="animate-slide-up">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-portal-800 bg-portal-50 border border-portal-100 mb-6">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Official Redressal System
                    </span>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.1]">
                        Your voice matters.
                        <span class="block mt-2 text-gradient-portal">Resolution you can trust.</span>
                    </h1>
                    <p class="mt-6 text-lg text-slate-600 leading-relaxed max-w-xl">
                        A modern, transparent platform connecting citizens with public authorities. Lodge grievances, track every step, and receive verified outcomes.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="btn btn-primary text-base px-8 py-3.5 shadow-portal-lg">
                            File a Grievance
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="#how-it-works" class="btn btn-secondary text-base px-8 py-3.5">How It Works</a>
                    </div>
                    <div class="mt-12 flex flex-wrap gap-8">
                        <div>
                            <p class="text-3xl font-black text-portal-900">24/7</p>
                            <p class="text-sm font-semibold text-slate-500 mt-1">Online access</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-emerald-600">100%</p>
                            <p class="text-sm font-semibold text-slate-500 mt-1">Trackable cases</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-portal-900">Secure</p>
                            <p class="text-sm font-semibold text-slate-500 mt-1">Citizen data</p>
                        </div>
                    </div>
                </div>

                <div class="relative animate-fade-in lg:delay-100">
                    <div class="card-glass rounded-3xl p-6 sm:p-8 shadow-portal-lg border border-white/60">
                        <div class="flex items-center justify-between mb-6">
                            <span class="text-sm font-bold text-slate-700">Live grievance tracker</span>
                            <span class="badge badge-in-progress text-[10px]">In Progress</span>
                        </div>
                        <div class="space-y-4">
                            @foreach(['Submitted', 'Under Review', 'Officer Assigned', 'Resolution'] as $i => $step)
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $i < 3 ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-400' }}">
                                    @if($i < 3)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    @else
                                        <span class="text-xs font-bold">{{ $i + 1 }}</span>
                                    @endif
                                </div>
                                <div class="flex-grow py-2 border-b border-slate-100 last:border-0">
                                    <p class="text-sm font-bold text-slate-800">{{ $step }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $i < 3 ? 'Completed' : 'Pending' }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -left-4 card px-4 py-3 shadow-portal hidden sm:flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-500 uppercase">Avg. resolution</p>
                            <p class="text-sm font-extrabold text-slate-900">Fast & accountable</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-white border-y border-slate-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-2xl hover:bg-slate-50 transition-colors group">
                    <div class="w-14 h-14 mx-auto bg-portal-50 rounded-2xl flex items-center justify-center text-portal-700 mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Full Transparency</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Track grievance status at every stage with complete visibility from submission to resolution.</p>
                </div>
                <div class="text-center p-6 rounded-2xl hover:bg-slate-50 transition-colors group">
                    <div class="w-14 h-14 mx-auto bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-700 mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Public Accountability</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Complaints are assigned to concerned dealing officers ensuring responsible, timely action.</p>
                </div>
                <div class="text-center p-6 rounded-2xl hover:bg-slate-50 transition-colors group">
                    <div class="w-14 h-14 mx-auto bg-amber-50 rounded-2xl flex items-center justify-center text-amber-700 mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Swift Resolution</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Escalation mechanisms ensure critical issues receive priority administrative attention.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">How the portal works</h2>
                <p class="mt-4 text-lg text-slate-600">A streamlined workflow designed for citizens and administrators alike.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="card p-8 hover:-translate-y-1 transition-all duration-300 group">
                    <span class="text-4xl font-black text-portal-100 group-hover:text-portal-200 transition-colors">01</span>
                    <h3 class="mt-4 text-xl font-bold text-slate-900">Register & Report</h3>
                    <p class="mt-3 text-slate-600 text-sm leading-relaxed">Create your account and submit a detailed grievance with location, contact, and optional attachments.</p>
                </div>
                <div class="card p-8 hover:-translate-y-1 transition-all duration-300 group">
                    <span class="text-4xl font-black text-emerald-100 group-hover:text-emerald-200 transition-colors">02</span>
                    <h3 class="mt-4 text-xl font-bold text-slate-900">Track & Monitor</h3>
                    <p class="mt-3 text-slate-600 text-sm leading-relaxed">Follow real-time status updates as your case moves through review and officer assignment.</p>
                </div>
                <div class="card p-8 hover:-translate-y-1 transition-all duration-300 group">
                    <span class="text-4xl font-black text-sky-100 group-hover:text-sky-200 transition-colors">03</span>
                    <h3 class="mt-4 text-xl font-bold text-slate-900">Resolve & Feedback</h3>
                    <p class="mt-3 text-slate-600 text-sm leading-relaxed">Receive official remarks on resolution and rate your experience to improve public services.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 hero-gradient relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.04\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Ready to make your voice heard?</h2>
            <p class="mt-4 text-lg text-blue-100/90">Join thousands of citizens using the official grievance redressal platform.</p>
            <a href="{{ route('register') }}" class="mt-8 inline-flex btn bg-white text-portal-900 hover:bg-slate-50 border-0 shadow-xl text-base px-10 py-3.5 font-bold">
                Create Free Account
            </a>
        </div>
    </section>

    <footer class="bg-slate-950 text-slate-400 py-14">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8 pb-10 border-b border-slate-800">
                <x-portal-logo size="md" class="[&_span]:text-white [&_span:last-child]:text-slate-500" :show-text="true" />
                <div class="flex gap-8 text-sm font-medium">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Contact</a>
                </div>
            </div>
            <p class="pt-8 text-center text-sm text-slate-500">&copy; {{ date('Y') }} Public Grievance Redressal System. Built for accountable governance.</p>
        </div>
    </footer>
</body>
</html>
