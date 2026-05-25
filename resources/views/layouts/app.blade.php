<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Grievance Portal') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * { box-sizing: border-box; }
        body { background: #0b1525 !important; font-family: 'Outfit', sans-serif !important; color: #e8f4ff; min-height:100vh; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: rgba(255,255,255,0.04); }
        ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 3px; }
        ::selection { background: rgba(59,130,246,0.35); color: #e8f4ff; }
        a { text-decoration: none; }
        input, select, textarea, button { font-family: 'Outfit', sans-serif; }
        .glass-card { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 12px; padding: 1.25rem 1.5rem; }
        .stat-label { font-size:11px; text-transform:uppercase; letter-spacing:0.1em; color:rgba(255,255,255,0.4); margin-bottom:6px; }
        .stat-number { font-size:32px; font-weight:600; color:#e8f4ff; line-height:1; }
        .btn-primary { background:#3b82f6; color:#fff; border:none; padding:9px 22px; border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; }
        .btn-outline { background:transparent; color:rgba(255,255,255,0.65); border:1px solid rgba(255,255,255,0.2); padding:8px 20px; border-radius:8px; font-size:13px; }
        .form-input { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.15); border-radius: 8px; color: #e8f4ff; font-size:14px; padding:10px 14px; width:100%; outline:none; }
        .status-pending{ background:rgba(251,191,36,0.12); color:#fbbf24; border:1px solid rgba(251,191,36,0.28); border-radius:20px; padding:3px 12px; font-size:11px; font-weight:600; }
        .status-inprogress{ background:rgba(99,102,241,0.15); color:#a5b4fc; border:1px solid rgba(99,102,241,0.3); border-radius:20px; padding:3px 12px; font-size:11px; font-weight:600; }
        .status-resolved{ background:rgba(52,211,153,0.12); color:#34d399; border:1px solid rgba(52,211,153,0.28); border-radius:20px; padding:3px 12px; font-size:11px; font-weight:600; }
        .status-closed{ background:rgba(255,255,255,0.07); color:rgba(255,255,255,0.5); border:1px solid rgba(255,255,255,0.15); border-radius:20px; padding:3px 12px; font-size:11px; font-weight:600; }

        /* Compatibility fallbacks for existing templates */
        .card { background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.04); border-radius: 12px; padding: 1rem; }
        .card.bg-white { background: rgba(255,255,255,0.03) !important; color: #e8f4ff !important; }
        .btn { display:inline-flex;align-items:center;justify-content:center;padding:8px 14px;border-radius:8px;border:1px solid rgba(255,255,255,0.06);background:rgba(255,255,255,0.03);color:rgba(255,255,255,0.9);cursor:pointer }
        .btn.bg-white { background:#ffffff; color:#0b1525 }
        .btn-primary { background:#3b82f6; color:#fff; border:none; padding:9px 22px; border-radius:8px; font-size:13px; font-weight:500; cursor:pointer; }
        .btn-danger { background:transparent;color:#f87171;border:1px solid rgba(239,68,68,0.25);padding:8px 12px;border-radius:8px }
        .badge { display:inline-block;padding:4px 10px;border-radius:999px;font-size:12px;font-weight:700;background:rgba(255,255,255,0.04);color:rgba(255,255,255,0.8);border:1px solid rgba(255,255,255,0.04); }

        .glass-header { background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(24px); border-bottom: 1px solid rgba(255,255,255,0.08); }
        .bg-white, .bg-slate-50, .bg-slate-100, .bg-slate-200, .bg-slate-200\/60, .bg-slate-100\/50, .bg-slate-50\/50, .bg-white\/50, .bg-portal-50, .bg-emerald-50, .bg-amber-50, .bg-sky-50, .bg-rose-50, .bg-slate-900\/70 {
            background: rgba(255,255,255,0.05) !important;
        }
        .text-slate-900, .text-slate-800, .text-slate-700, .text-slate-600, .text-slate-500, .text-slate-400 {
            color: #e8f4ff !important;
        }
        .border-slate-200, .border-slate-100, .border-slate-50, .border-white, .border-portal-100\/60, .border-slate-200\/60 {
            border-color: rgba(255,255,255,0.08) !important;
        }
        .shadow-sm, .shadow-lg, .shadow-xl, .shadow-portal, .shadow-portal-lg, .shadow-rose-200 {
            box-shadow: 0 16px 40px -28px rgba(0, 0, 0, 0.55) !important;
        }
        .hover\:bg-slate-50:hover, .hover\:bg-white\/5:hover, .hover\:bg-portal-50:hover, .hover\:bg-emerald-50:hover, .hover\:bg-rose-50:hover {
            background: rgba(255,255,255,0.06) !important;
        }

        /* Table tweaks for dark glass look */
        table { border-collapse:collapse;width:100% }
        thead th { background: rgba(255,255,255,0.02); }
        tbody tr { border-top:1px solid rgba(255,255,255,0.03); }

    </style>
</head>
<body style="background:#0b1525; font-family:'Outfit',sans-serif; color:#e8f4ff; min-height:100vh">
    <div id="page-loader" class="fixed inset-x-0 top-0 h-1 scale-x-0 opacity-0 transform origin-left bg-gradient-to-r from-emerald-400 via-portal-500 to-blue-400 transition-all duration-500 ease-out z-50"></div>

    <div class="page-shell relative overflow-hidden lg:flex lg:min-h-screen">
        <div class="pointer-events-none absolute inset-0">
            <div class="floating-shape left-1/4 top-16 h-72 w-72 bg-emerald-400/20 blur-3xl"></div>
            <div class="floating-shape right-0 top-40 h-80 w-80 bg-sky-500/15 blur-3xl"></div>
            <div class="floating-shape left-0 bottom-24 h-72 w-72 bg-portal-800/10 blur-3xl"></div>
        </div>

        @include('layouts.navigation')

        <div class="flex-1 min-h-screen lg:overflow-hidden">
            @isset($header)
                <header class="glass-header relative z-10 lg:sticky lg:top-0 lg:z-30">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 animate-slide-down">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="relative z-10 flex-grow pb-24">
                <div class="max-w-7xl mx-auto pt-6 px-4 sm:px-6 lg:px-8">
                    <x-flash-messages />
                </div>
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
