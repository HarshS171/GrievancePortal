<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Grievance Portal') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased min-h-screen bg-slate-950 text-white selection:bg-emerald-400 selection:text-slate-900">
    <div class="min-h-screen flex flex-col lg:flex-row">
        {{-- Brand panel --}}
        <div class="relative lg:w-[45%] xl:w-[42%] min-h-[220px] lg:min-h-screen hero-gradient overflow-hidden flex flex-col justify-between p-8 sm:p-12">
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-emerald-500/10 blur-3xl animate-float"></div>
                <div class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent"></div>
                <div class="absolute top-1/3 -left-20 w-64 h-64 rounded-full bg-white/5 blur-2xl"></div>
            </div>

            <a href="{{ url('/') }}" class="relative z-10">
                <x-portal-logo size="lg" :show-text="true" class="[&_span]:text-white [&_span:last-child]:text-emerald-200/80" />
            </a>

            <div class="relative z-10 mt-8 lg:mt-0 max-w-md">
                <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/10 border border-white/20 text-emerald-200 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Official Portal
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold leading-tight tracking-tight">
                    Transparent grievance redressal for every citizen.
                </h1>
                <p class="mt-4 text-base text-blue-100/90 leading-relaxed">
                    Lodge complaints, track resolution in real time, and hold public authorities accountable through a secure digital channel.
                </p>
                <ul class="mt-8 space-y-3 text-sm font-medium text-blue-100/80">
                    <li class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        End-to-end status tracking
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Direct officer assignment
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-300 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        </span>
                        Verified resolution feedback
                    </li>
                </ul>
            </div>

            <p class="relative z-10 text-xs text-blue-200/60 mt-8 hidden lg:block">&copy; {{ date('Y') }} Grievance Redressal System</p>
        </div>

        {{-- Form panel --}}
        <div class="flex-1 flex flex-col justify-center items-center px-6 py-10 sm:px-12 bg-slate-50">
            <div class="w-full max-w-md animate-slide-up">
                <div class="card-elevated p-8 sm:p-10 bg-white">
                    {{ $slot }}
                </div>
                <p class="mt-8 text-center text-sm text-slate-500 lg:hidden">&copy; {{ date('Y') }} Grievance Redressal System</p>
            </div>
        </div>
    </div>
</body>
</html>
