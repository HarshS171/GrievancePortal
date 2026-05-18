<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Public Grievance Portal | Ensuring Your Voice is Heard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased text-gray-900">
    
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-indigo-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-gray-900">GrievancePortal</span>
                </div>
                <div class="flex items-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-gray-900 transition-colors px-4 py-2">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary shadow-lg shadow-indigo-200">Get Started</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background decorative elements -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center max-w-4xl mx-auto">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold text-indigo-600 bg-indigo-50 mb-8 border border-indigo-100">
                    <span class="w-2 h-2 rounded-full bg-indigo-600 mr-2 animate-pulse"></span>
                    Official Redressal System 2.0
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-8 leading-tight">
                    Ensuring Your Voice Is <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Heard.</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    A modern, transparent platform designed to bridge the gap between citizens and administration. Submit, track, and resolve grievances with full visibility.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('register') }}" class="btn btn-primary text-lg px-8 py-4 w-full sm:w-auto shadow-xl shadow-indigo-200/50">
                        File a Complaint
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                    <a href="#how-it-works" class="btn btn-secondary text-lg px-8 py-4 w-full sm:w-auto bg-white hover:bg-gray-50 text-gray-700">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
        
        <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]"></div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="relative z-20 -mt-12 mb-20 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-100 text-center">
                <div class="p-4">
                    <p class="text-5xl font-extrabold text-indigo-600 mb-2">98%</p>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Satisfaction Rate</p>
                </div>
                <div class="p-4">
                    <p class="text-5xl font-extrabold text-indigo-600 mb-2">48h</p>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Response Time</p>
                </div>
                <div class="p-4">
                    <p class="text-5xl font-extrabold text-indigo-600 mb-2">12k+</p>
                    <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Resolved Cases</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="how-it-works" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Streamlined Resolution Process</h2>
                <p class="text-lg text-gray-600">We've built a transparent workflow to ensure every grievance is tracked and addressed promptly by the right authorities.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
                <div class="group">
                    <div class="w-20 h-20 mx-auto bg-white rounded-2xl shadow-md border border-gray-100 flex items-center justify-center text-3xl font-bold text-indigo-600 mb-6 transform group-hover:-translate-y-2 transition-transform duration-300">1</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Report</h3>
                    <p class="text-gray-600">Submit your grievance easily with detailed descriptions and supporting image attachments.</p>
                </div>
                <div class="group">
                    <div class="w-20 h-20 mx-auto bg-white rounded-2xl shadow-md border border-gray-100 flex items-center justify-center text-3xl font-bold text-indigo-600 mb-6 transform group-hover:-translate-y-2 transition-transform duration-300 delay-100">2</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Process</h3>
                    <p class="text-gray-600">The administration reviews and assigns your case to the relevant department for swift action.</p>
                </div>
                <div class="group">
                    <div class="w-20 h-20 mx-auto bg-white rounded-2xl shadow-md border border-gray-100 flex items-center justify-center text-3xl font-bold text-indigo-600 mb-6 transform group-hover:-translate-y-2 transition-transform duration-300 delay-200">3</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Resolve</h3>
                    <p class="text-gray-600">Receive official confirmation and provide feedback on the resolution once completed.</p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center border-b border-gray-800 pb-8 mb-8">
                <div class="flex items-center gap-3 mb-6 md:mb-0">
                    <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    </div>
                    <span class="text-xl font-bold text-white">GrievancePortal</span>
                </div>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                    <a href="#" class="hover:text-white transition-colors">Contact</a>
                </div>
            </div>
            <div class="text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Public Grievance Redressal System. Built for better governance.
            </div>
        </div>
    </footer>
</body>
</html>
