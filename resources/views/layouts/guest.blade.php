<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Grievance Portal') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50 selection:bg-indigo-500 selection:text-white">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-indigo-50 via-white to-slate-100">
        
        <!-- Background decoration -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-indigo-100/40 blur-3xl"></div>
            <div class="absolute top-[20%] -right-[10%] w-[40%] h-[40%] rounded-full bg-blue-100/40 blur-3xl"></div>
        </div>

        <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-2xl shadow-indigo-100/50 sm:rounded-3xl border border-slate-100 animate-slide-up">
            <div class="flex justify-center mb-8">
                <a href="/" class="group flex flex-col items-center gap-3">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-200 group-hover:scale-110 group-hover:rotate-3 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <span class="font-extrabold text-xl text-slate-900 tracking-tight">GrievancePortal</span>
                </a>
            </div>

            {{ $slot }}
        </div>
        
        <p class="mt-8 text-sm font-medium text-slate-500 relative z-10">
            &copy; {{ date('Y') }} GrievancePortal. All rights reserved.
        </p>
    </div>
</body>
</html>
