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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            [x-cloak] { display: none !important; }
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased overflow-x-hidden">
        <!-- Dark Mode Init -->
        <script>
            if (localStorage.getItem('darkMode') === 'true' || (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>

        <!-- Global Background Elements -->
        <div class="fixed inset-0 z-[-1] overflow-hidden pointer-events-none">
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-indigo-500/10 dark:bg-indigo-600/15 rounded-full filter blur-[120px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-500/10 dark:bg-blue-600/15 rounded-full filter blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="min-h-screen flex relative">
            <!-- Left Feature Panel (Desktop Only) -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-gradient-to-br from-indigo-600 via-indigo-700 to-violet-800" x-data="{
                activeSlide: 0,
                slides: [
                    { title: 'Share & Collaborate', desc: 'Upload and access premium study materials shared by your fellow DIU students.', icon: 'share' },
                    { title: 'Smart Search', desc: 'Find resources instantly by course code, department, or topic.', icon: 'search' },
                    { title: 'Build Your Portfolio', desc: 'Track your contributions and become a top contributor in the community.', icon: 'star' }
                ],
                init() { setInterval(() => this.activeSlide = (this.activeSlide + 1) % this.slides.length, 4000); }
            }">
                <!-- Abstract Pattern -->
                <div class="absolute inset-0">
                    <div class="absolute top-1/4 -left-20 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-1/4 -right-20 w-96 h-96 bg-violet-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-white/5 rounded-full"></div>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] border border-white/5 rounded-full"></div>
                </div>

                <div class="relative z-10 flex flex-col justify-between p-12 xl:p-16 w-full">
                    <!-- Logo -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/20 backdrop-blur-xl flex items-center justify-center text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <span class="text-xl font-extrabold text-white tracking-tight">DIU Hub</span>
                    </div>

                    <!-- Rotating Content -->
                    <div class="flex-grow flex items-center">
                        <div class="w-full">
                            <template x-for="(slide, idx) in slides" :key="idx">
                                <div x-show="activeSlide === idx" 
                                     x-transition:enter="transition ease-out duration-500" 
                                     x-transition:enter-start="opacity-0 translate-y-4" 
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     x-transition:leave="transition ease-in duration-300"
                                     x-transition:leave-start="opacity-100" 
                                     x-transition:leave-end="opacity-0"
                                     class="space-y-6">
                                    <div class="w-16 h-16 rounded-2xl bg-white/10 backdrop-blur-xl flex items-center justify-center mb-8">
                                        <svg x-show="slide.icon === 'share'" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                        <svg x-show="slide.icon === 'search'" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        <svg x-show="slide.icon === 'star'" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                    </div>
                                    <h2 class="text-4xl xl:text-5xl font-black text-white tracking-tight leading-tight" x-text="slide.title"></h2>
                                    <p class="text-indigo-200 text-lg xl:text-xl leading-relaxed max-w-md" x-text="slide.desc"></p>
                                </div>
                            </template>

                            <!-- Slide Dots -->
                            <div class="flex gap-2 mt-10">
                                <template x-for="(slide, idx) in slides" :key="'dot-'+idx">
                                    <button @click="activeSlide = idx" 
                                        :class="activeSlide === idx ? 'w-8 bg-white' : 'w-2 bg-white/30 hover:bg-white/50'" 
                                        class="h-2 rounded-full transition-all duration-300"></button>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom -->
                    <p class="text-indigo-300/60 text-sm font-medium">© {{ date('Y') }} DIU Hub. All rights reserved.</p>
                </div>
            </div>

            <!-- Right Auth Form Panel -->
            <div class="w-full lg:w-1/2 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 p-4 sm:p-8 relative bg-slate-50 dark:bg-slate-900">
                <!-- Mobile-only logo -->
                <div class="mb-8 lg:hidden">
                    <a href="/" class="flex flex-col items-center gap-2 group">
                        <div class="p-4 bg-white dark:bg-slate-800 rounded-2xl shadow-xl shadow-indigo-500/10 group-hover:scale-110 transition-transform duration-500">
                            <x-application-logo class="w-12 h-12 fill-current text-indigo-600 dark:text-indigo-400" />
                        </div>
                        <span class="text-2xl font-black tracking-tighter text-slate-900 dark:text-white uppercase">{{ config('app.name') }}</span>
                    </a>
                </div>

                <div class="w-full sm:max-w-md bg-white/70 dark:bg-slate-800/70 backdrop-blur-2xl px-8 py-10 shadow-2xl shadow-slate-200/50 dark:shadow-none border border-white/20 dark:border-slate-700/50 rounded-[2.5rem]">
                    {{ $slot }}
                </div>

                <!-- Mobile footer -->
                <div class="mt-8 text-center lg:hidden">
                    <p class="text-sm font-medium text-slate-500">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                </div>
            </div>
        </div>

        <!-- AOS JS -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (typeof AOS !== 'undefined') {
                    AOS.init({ once: true, duration: 800 });
                }
            });
        </script>
    </body>
</html>
