<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- AOS Animation CSS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

        <style>
            [x-cloak] { display: none !important; }

            html { scroll-behavior: smooth; }

            /* Loading Screen */
            #global-loader {
                position: fixed;
                inset: 0;
                z-index: 9999;
                background: #f8fafc;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.6s;
            }
            html.dark #global-loader { background: #0f172a; }
            #global-loader.loader-hidden { opacity: 0; visibility: hidden; }

            .loader-dots {
                display: flex;
                gap: 8px;
                margin-bottom: 32px;
            }
            .loader-dots span {
                width: 14px;
                height: 14px;
                border-radius: 50%;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                animation: dot-bounce 1.4s ease-in-out infinite;
            }
            .loader-dots span:nth-child(2) { animation-delay: 0.16s; }
            .loader-dots span:nth-child(3) { animation-delay: 0.32s; }

            @keyframes dot-bounce {
                0%, 80%, 100% { transform: scale(0.6); opacity: 0.4; }
                40% { transform: scale(1.2); opacity: 1; }
            }

            .loader-brand {
                font-size: 1.5rem;
                font-weight: 800;
                background: linear-gradient(135deg, #6366f1, #8b5cf6);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                letter-spacing: -0.03em;
                margin-bottom: 8px;
            }
            .loader-subtitle {
                font-size: 0.875rem;
                font-weight: 500;
                color: #94a3b8;
                letter-spacing: 0.01em;
            }
            html.dark .loader-subtitle { color: #64748b; }

            /* Skeleton Loading Shimmer */
            .skeleton {
                background: linear-gradient(90deg, #e2e8f0 25%, #f1f5f9 50%, #e2e8f0 75%);
                background-size: 200% 100%;
                animation: skeleton-shimmer 1.5s ease-in-out infinite;
                border-radius: 0.75rem;
            }
            html.dark .skeleton {
                background: linear-gradient(90deg, #1e293b 25%, #334155 50%, #1e293b 75%);
                background-size: 200% 100%;
            }
            @keyframes skeleton-shimmer {
                0% { background-position: 200% 0; }
                100% { background-position: -200% 0; }
            }

            /* Bookmark Bounce Micro-interaction */
            @keyframes bookmark-bounce {
                0%, 100% { transform: scale(1); }
                30% { transform: scale(1.35); }
                50% { transform: scale(0.9); }
                70% { transform: scale(1.1); }
            }
            .bookmark-bounce { animation: bookmark-bounce 0.5s ease; }

            /* Upload Success Confetti */
            @keyframes confetti-fall {
                0% { transform: translateY(-100vh) rotate(0deg); opacity: 1; }
                100% { transform: translateY(100vh) rotate(720deg); opacity: 0; }
            }
        </style>

        <!-- Dark Mode Initialization -->
        <script>
            if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200">
        <!-- Global Loading Screen -->
        <div id="global-loader">
            <div class="loader-brand">DIU Study Hub</div>
            <div class="loader-subtitle">Loading your resources...</div>
            <div class="loader-dots" style="margin-top: 24px;">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        
        <!-- Global Background Elements (Glassmorphism & Orbs) -->
        <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-400/20 dark:bg-indigo-600/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-violet-400/20 dark:bg-violet-600/20 rounded-full mix-blend-multiply filter blur-3xl opacity-70"></div>
        </div>

        <div class="min-h-screen flex flex-col relative">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white/70 dark:bg-slate-800/70 backdrop-blur-lg border-b border-slate-200/50 dark:border-slate-700/50 shadow-sm sticky top-16 z-30">
                    <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            <x-footer />
            <x-toast />
        </div>

        <!-- AOS JS -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            // Smart Loading Screen & AOS Controller
            (function() {
                var loader = document.getElementById('global-loader');

                // --- Smart Loader Logic ---
                // Show loader ONLY on first visit or refresh, NOT on internal navigation.
                var isInternalNav = sessionStorage.getItem('diu_navigating') === '1';

                if (isInternalNav) {
                    // Internal navigation: hide loader instantly, no delay
                    if (loader) loader.classList.add('loader-hidden');
                } else {
                    // First visit or page refresh: show loader for exactly 2 seconds
                    setTimeout(function() {
                        if (loader) loader.classList.add('loader-hidden');
                    }, 2000);
                }

                // Clear the flag after reading it (so a manual refresh resets it)
                sessionStorage.removeItem('diu_navigating');

                // Mark all link clicks and form submissions as internal navigation
                document.addEventListener('click', function(e) {
                    var link = e.target.closest('a[href]');
                    if (link && link.href && link.origin === window.location.origin && !link.hasAttribute('download')) {
                        sessionStorage.setItem('diu_navigating', '1');
                    }
                });
                document.addEventListener('submit', function() {
                    sessionStorage.setItem('diu_navigating', '1');
                });

                // Safety fallback: if loader is somehow still visible after 3.5s, force-hide it
                setTimeout(function() {
                    if (loader && !loader.classList.contains('loader-hidden')) {
                        loader.classList.add('loader-hidden');
                    }
                }, 3500);

                // --- AOS Init ---
                function initAOS() {
                    if (typeof AOS !== 'undefined') {
                        AOS.init({ 
                            once: true, 
                            offset: 50,
                            delay: 0,
                            duration: 600,
                            easing: 'ease-out-cubic'
                        });
                    }
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initAOS);
                } else {
                    initAOS();
                }

                window.addEventListener('pageshow', function() {
                    if (!window.location.hash) window.scrollTo(0, 0);
                });

                // --- Upload Success Confetti ---
                @if(session('success') && str_contains(session('success'), 'uploaded'))
                (function() {
                    var colors = ['#6366f1','#8b5cf6','#f59e0b','#10b981','#ef4444','#3b82f6'];
                    for (var i = 0; i < 40; i++) {
                        var confetti = document.createElement('div');
                        confetti.style.cssText = 'position:fixed;top:-10px;width:' + (6 + Math.random()*6) + 'px;height:' + (6 + Math.random()*6) + 'px;background:' + colors[Math.floor(Math.random()*colors.length)] + ';left:' + Math.random()*100 + 'vw;z-index:10000;border-radius:' + (Math.random()>0.5?'50%':'2px') + ';animation:confetti-fall ' + (2+Math.random()*3) + 's linear ' + Math.random()*2 + 's forwards;pointer-events:none;';
                        document.body.appendChild(confetti);
                        setTimeout(function(el){ el.remove(); }.bind(null, confetti), 6000);
                    }
                })();
                @endif
            })();
        </script>
    </body>
</html>
