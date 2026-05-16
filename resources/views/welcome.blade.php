<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Public Grievance Portal | Ensuring Your Voice is Heard</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .hero-gradient {
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
                position: relative;
                overflow: hidden;
            }
            .hero-pattern {
                position: absolute;
                inset: 0;
                background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.1) 1px, transparent 0);
                background-size: 40px 40px;
                opacity: 0.5;
            }
            .floating {
                animation: floating 3s ease-in-out infinite;
            }
            @keyframes floating {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
            }
        </style>
    </head>
    <body class="bg-white">
        <!-- Navigation -->
        <nav class="navbar glass" style="background: rgba(255,255,255,0.9);">
            <div class="container">
                <div class="nav-content">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="padding: 8px; background: var(--primary); border-radius: 10px; color: white; display: flex;">
                            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                        </div>
                        <span style="font-size: 1.5rem; font-weight: 800; color: var(--text-main);">GrievancePortal</span>
                    </div>
                    <div class="nav-links">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-secondary">Log In</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="hero-gradient" style="padding: 120px 0 160px;">
            <div class="hero-pattern"></div>
            <div class="container" style="position: relative; z-index: 10;">
                <div class="grid grid-cols-2" style="align-items: center; gap: 80px;">
                    <div style="animation: slideIn 0.6s ease-out;">
                        <span style="background: rgba(255,255,255,0.2); color: white; padding: 6px 16px; border-radius: 20px; font-size: 0.875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; display: inline-block; margin-bottom: 24px; backdrop-filter: blur(5px);">Official Redressal System</span>
                        <h1 style="color: white; font-size: 4.5rem; line-height: 1.1; margin-bottom: 32px;">Ensuring Your Voice Is <span style="color: #cbd5e1;">Heard.</span></h1>
                        <p style="color: #e2e8f0; font-size: 1.25rem; margin-bottom: 48px; max-width: 550px; line-height: 1.6;">A modern, transparent platform designed to bridge the gap between citizens and administration. Submit, track, and resolve grievances with full visibility.</p>
                        <div style="display: flex; gap: 20px;">
                            <a href="{{ route('register') }}" class="btn" style="background: white; color: var(--primary); padding: 18px 40px; font-size: 1.125rem; border-radius: 14px; font-weight: 800; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">File a Complaint</a>
                            <a href="#how-it-works" class="btn btn-secondary" style="background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.3); color: white; padding: 18px 32px; border-radius: 14px; backdrop-filter: blur(10px);">Learn More</a>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; animation: slideIn 0.8s ease-out;">
                        <div class="floating" style="background: rgba(255,255,255,0.1); padding: 40px; border-radius: 40px; backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.2); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.3);">
                            <div class="grid grid-cols-1" style="gap: 20px;">
                                <div class="card" style="padding: 20px; display: flex; align-items: center; gap: 16px; min-width: 320px;">
                                    <div style="background: #ecfdf5; color: #10b981; padding: 10px; border-radius: 12px;"><svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                                    <div><div style="font-weight: 800; color: var(--text-main);">Resolution Complete</div><div style="font-size: 0.75rem; color: var(--text-muted);">Grievance #882 has been resolved</div></div>
                                </div>
                                <div class="card" style="padding: 20px; display: flex; align-items: center; gap: 16px; transform: translateX(40px);">
                                    <div style="background: #fffbeb; color: #f59e0b; padding: 10px; border-radius: 12px;"><svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                                    <div><div style="font-weight: 800; color: var(--text-main);">In Progress</div><div style="font-size: 0.75rem; color: var(--text-muted);">Admin is reviewing your request</div></div>
                                </div>
                                <div class="card" style="padding: 20px; display: flex; align-items: center; gap: 16px;">
                                    <div style="background: #eff6ff; color: #3b82f6; padding: 10px; border-radius: 12px;"><svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg></div>
                                    <div><div style="font-weight: 800; color: var(--text-main);">Direct Response</div><div style="font-size: 0.75rem; color: var(--text-muted);">Notification sent to email</div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Stats Section -->
        <section style="margin-top: -80px; position: relative; z-index: 20;">
            <div class="container">
                <div class="card" style="padding: 40px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.05);">
                    <div class="grid grid-cols-3">
                        <div style="text-align: center; border-right: 1px solid var(--border);">
                            <div style="font-size: 3rem; font-weight: 800; color: var(--primary);">98%</div>
                            <div style="text-transform: uppercase; font-size: 0.875rem; font-weight: 700; color: var(--text-muted); letter-spacing: 0.05em;">Satisfaction Rate</div>
                        </div>
                        <div style="text-align: center; border-right: 1px solid var(--border);">
                            <div style="font-size: 3rem; font-weight: 800; color: var(--primary);">48h</div>
                            <div style="text-transform: uppercase; font-size: 0.875rem; font-weight: 700; color: var(--text-muted); letter-spacing: 0.05em;">Response Time</div>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 3rem; font-weight: 800; color: var(--primary);">12k+</div>
                            <div style="text-transform: uppercase; font-size: 0.875rem; font-weight: 700; color: var(--text-muted); letter-spacing: 0.05em;">Resolved Cases</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section id="how-it-works" class="section-py" style="background: #fdfdfd;">
            <div class="container">
                <div style="text-align: center; margin-bottom: 80px;">
                    <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Streamlined Resolution Process</h2>
                    <p style="font-size: 1.125rem; max-width: 700px; margin: 0 auto;">We've built a transparent workflow to ensure every grievance is tracked and addressed promptly.</p>
                </div>

                <div class="grid grid-cols-3">
                    <div style="text-align: center;">
                        <div style="width: 80px; height: 80px; background: var(--background); border-radius: 24px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin: 0 auto 30px; font-size: 2rem; font-weight: 800;">1</div>
                        <h3>Report</h3>
                        <p>Submit your grievance with descriptions and supporting attachments.</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 80px; height: 80px; background: var(--background); border-radius: 24px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin: 0 auto 30px; font-size: 2rem; font-weight: 800;">2</div>
                        <h3>Process</h3>
                        <p>The administration reviews and assigns your case to the relevant department.</p>
                    </div>
                    <div style="text-align: center;">
                        <div style="width: 80px; height: 80px; background: var(--background); border-radius: 24px; display: flex; align-items: center; justify-content: center; color: var(--primary); margin: 0 auto 30px; font-size: 2rem; font-weight: 800;">3</div>
                        <h3>Resolve</h3>
                        <p>Receive official confirmation and provide feedback on the resolution.</p>
                    </div>
                </div>
            </div>
        </section>

        <footer style="padding: 80px 0; background: #0f172a; color: white;">
            <div class="container">
                <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 40px; margin-bottom: 40px;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <div style="padding: 8px; background: var(--primary); border-radius: 8px; color: white;"><svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg></div>
                        <span style="font-size: 1.5rem; font-weight: 800;">GrievancePortal</span>
                    </div>
                    <div style="display: flex; gap: 32px;">
                        <a href="#" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Privacy Policy</a>
                        <a href="#" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Terms of Service</a>
                        <a href="#" style="color: #94a3b8; text-decoration: none; font-weight: 600;">Contact Support</a>
                    </div>
                </div>
                <div style="text-align: center; color: #64748b; font-size: 0.875rem;">
                    &copy; {{ date('Y') }} Public Grievance Redressal System. Built for better governance.
                </div>
            </div>
        </footer>
    </body>
</html>
