<x-app-layout>
    <!-- Hero Section -->
    <div class="relative overflow-hidden pt-16 pb-24 sm:pt-24 sm:pb-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div data-aos="fade-down" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-800/50 text-indigo-600 dark:text-indigo-400 text-xs font-bold uppercase tracking-widest mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    The Ultimate Student Hub
                </div>
                
                <h1 data-aos="fade-up" class="text-5xl sm:text-7xl font-black text-slate-900 dark:text-white tracking-tight leading-[1.1] mb-8">
                    Elevate Your <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-violet-600 dark:from-indigo-400 dark:to-violet-400">Academic Game</span>
                </h1>
                
                <p data-aos="fade-up" data-aos-delay="100" class="max-w-2xl mx-auto text-lg sm:text-xl text-slate-500 dark:text-slate-400 leading-relaxed mb-12">
                    Access premium study materials, lecture notes, and previous questions shared by the Daffodil International University community.
                </p>
                
                <div data-aos="fade-up" data-aos-delay="200" class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('resources.index') }}" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-extrabold text-lg shadow-xl shadow-indigo-500/25 transition-all hover:-translate-y-1 active:scale-95 flex items-center gap-2">
                        Browse Materials
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-white dark:bg-slate-800 text-slate-900 dark:text-white border border-slate-200 dark:border-slate-700 rounded-2xl font-extrabold text-lg shadow-sm hover:shadow-md hover:bg-slate-50 dark:hover:bg-slate-700 transition-all hover:-translate-y-1 active:scale-95">
                        Join DIU Hub
                    </a>
                </div>

                <!-- Floating Stats Bar -->
                <div data-aos="fade-up" data-aos-delay="350" class="mt-16 inline-flex flex-wrap justify-center gap-6 sm:gap-10 px-8 py-5 bg-white/60 dark:bg-slate-800/60 backdrop-blur-xl rounded-2xl border border-slate-200/50 dark:border-slate-700/50 shadow-lg" x-data="{
                    counters: [
                        { target: {{ $totalResources ?? 0 }}, current: 0, suffix: '+', label: 'Resources' },
                        { target: {{ $totalContributors ?? 0 }}, current: 0, suffix: '+', label: 'Contributors' },
                        { target: {{ $totalFaculties ?? 0 }}, current: 0, suffix: '+', label: 'Faculties' }
                    ],
                    startCounter() {
                        this.counters.forEach((c, i) => {
                            if (c.target <= 0) return;
                            let step = Math.max(1, Math.ceil(c.target / 30));
                            let interval = setInterval(() => {
                                c.current = Math.min(c.current + step, c.target);
                                if (c.current >= c.target) clearInterval(interval);
                            }, 40);
                        });
                    }
                }" x-init="setTimeout(() => startCounter(), 300)">
                    <template x-for="(stat, idx) in counters" :key="idx">
                        <div class="text-center">
                            <div class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white tracking-tight">
                                <span x-text="stat.current"></span><span class="text-indigo-500" x-text="stat.suffix"></span>
                            </div>
                            <div class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1" x-text="stat.label"></div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        
        <!-- Animated Background Blobs (SaaS Style) -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
            <div class="absolute top-1/4 -left-20 w-72 h-72 bg-indigo-400/10 dark:bg-indigo-600/10 rounded-full blur-[100px] animate-blob"></div>
            <div class="absolute bottom-1/4 -right-20 w-72 h-72 bg-violet-400/10 dark:bg-violet-600/10 rounded-full blur-[100px] animate-blob animation-delay-2000"></div>
        </div>
    </div>

    <!-- Featured Resources Carousel -->
    <section data-aos="fade-up" class="bg-slate-50/50 dark:bg-slate-900/50 border-y border-slate-100 dark:border-slate-800/50">
        <x-resource-carousel title="Featured Materials" :resources="$featuredResources" />
    </section>

    <!-- Trending Resources Carousel -->
    <section>
        <x-resource-carousel title="Trending Now" :resources="$trendingResources" />
    </section>

    <!-- Features Section (Apple Style) -->
    <section class="py-24 bg-white dark:bg-slate-900 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-4">Everything You Need</h2>
                <div class="h-1.5 w-16 bg-indigo-600 rounded-full mx-auto"></div>
            </div>

            <div class="grid sm:grid-cols-3 gap-8">
                <div data-aos="fade-up" data-aos-delay="100" class="group p-8 rounded-[2.5rem] bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-800 transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-indigo-100 dark:bg-indigo-900/50 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Smart Templates</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">High-quality hand-written notes and slides formatted for perfect readability on any device.</p>
                </div>

                <div data-aos="fade-up" data-aos-delay="200" class="group p-8 rounded-[2.5rem] bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-800 transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-violet-100 dark:bg-violet-900/50 text-violet-600 dark:text-violet-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Instant Search</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Find resources by course code, department, or topic in milliseconds with our optimized search engine.</p>
                </div>

                <div data-aos="fade-up" data-aos-delay="300" class="group p-8 rounded-[2.5rem] bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-700/50 hover:bg-white dark:hover:bg-slate-800 transition-all duration-500 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <div class="w-14 h-14 rounded-2xl bg-teal-100 dark:bg-teal-900/50 text-teal-600 dark:text-teal-400 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3 text-slate-900 dark:text-white">Secure Access</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Strict DIU email validation ensures a safe and exclusive academic community for all members.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Top Contributors Leaderboard -->
    @if(isset($topContributors) && $topContributors->count() > 0)
    <section class="py-20 bg-slate-50/50 dark:bg-slate-900/50 border-y border-slate-100 dark:border-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white tracking-tight mb-4">Top Contributors</h2>
                <div class="h-1.5 w-16 bg-amber-500 rounded-full mx-auto mb-4"></div>
                <p class="text-slate-500 dark:text-slate-400 font-medium">Students making the biggest impact</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
                @foreach($topContributors as $index => $contributor)
                    <div data-aos="zoom-in" data-aos-delay="{{ $index * 80 }}" class="group relative bg-white dark:bg-slate-800 rounded-[2rem] p-6 border border-slate-100 dark:border-slate-700/50 hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-500 text-center hover:-translate-y-2">
                        <!-- Rank Badge -->
                        <div class="absolute -top-3 -right-3 w-8 h-8 rounded-full flex items-center justify-center text-xs font-black shadow-lg
                            {{ $index === 0 ? 'bg-gradient-to-br from-amber-400 to-yellow-600 text-white shadow-amber-500/30' : '' }}
                            {{ $index === 1 ? 'bg-gradient-to-br from-slate-300 to-slate-500 text-white shadow-slate-500/30' : '' }}
                            {{ $index === 2 ? 'bg-gradient-to-br from-orange-400 to-orange-700 text-white shadow-orange-500/30' : '' }}
                            {{ $index >= 3 ? 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400' : '' }}">
                            #{{ $index + 1 }}
                        </div>

                        <!-- Avatar -->
                        <div class="w-16 h-16 mx-auto rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white text-2xl font-black shadow-xl shadow-indigo-500/20 mb-4 group-hover:scale-110 transition-transform duration-500 overflow-hidden">
                            @php
                                $avatarPath = $contributor->profile?->avatar;
                                $fileExists = $avatarPath && file_exists(storage_path('app/public/' . $avatarPath));
                            @endphp
                            @if($avatarPath && $fileExists)
                                <img src="{{ asset('storage/' . $avatarPath) }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($contributor->name, 0, 1)) }}
                            @endif
                        </div>

                        <h4 class="font-bold text-slate-900 dark:text-white text-sm mb-1 truncate">{{ $contributor->name }}</h4>
                        <div class="flex items-center justify-center gap-1 text-xs font-bold text-indigo-600 dark:text-indigo-400">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            {{ $contributor->resources_count }} {{ Str::plural('upload', $contributor->resources_count) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Recent Uploads Carousel -->
    <section data-aos="fade-up" class="bg-slate-50/50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-800/50">
        <x-resource-carousel title="Recently Added" :resources="$recentResources" />
    </section>

    <!-- Final CTA -->
    <section class="py-24 relative overflow-hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div data-aos="zoom-in" class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-[3rem] p-12 sm:p-20 shadow-2xl shadow-indigo-500/40">
                <h2 class="text-3xl sm:text-5xl font-black text-white mb-8 tracking-tight">Ready to excel in your studies?</h2>
                <p class="text-indigo-100 text-lg mb-12 max-w-xl mx-auto font-medium">Join 5,000+ DIU students sharing notes and resources everyday.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}" class="px-10 py-5 bg-white text-indigo-600 rounded-2xl font-black text-xl shadow-xl hover:bg-indigo-50 transition-all hover:-translate-y-1 active:scale-95">Get Started Now</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
