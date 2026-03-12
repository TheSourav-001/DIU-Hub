<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Student Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Welcome Info -->
            <div data-aos="fade-down" class="relative overflow-hidden rounded-[2rem] bg-gradient-to-br from-indigo-900 via-indigo-800 to-violet-900 p-8 sm:p-12 shadow-2xl mb-10 group">
                <!-- Abstract Background Elements -->
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-gradient-to-br from-teal-400/20 to-indigo-400/20 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-700"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-64 h-64 bg-gradient-to-tr from-violet-500/20 to-purple-400/20 rounded-full blur-2xl pointer-events-none group-hover:scale-110 transition-transform duration-700 delay-100"></div>
                
                <div class="relative z-10 flex flex-col sm:flex-row justify-between items-center gap-8">
                    <div>
                        <h3 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight mb-2">Welcome back, {{ explode(' ', $user->name)[0] }}!</h3>
                        <p class="text-indigo-200 text-lg font-medium">{{ $user->email }}</p>
                    </div>
                    <div>
                        <a href="{{ route('resources.create') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-900 hover:bg-indigo-50 rounded-2xl font-bold transition-all duration-300 shadow-[0_0_40px_rgba(255,255,255,0.3)] hover:shadow-[0_0_60px_rgba(255,255,255,0.5)] hover:-translate-y-1">
                            <span class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </span>
                            Upload Resource
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div data-aos="fade-up" class="grid grid-cols-3 gap-4 mb-10">
                <a href="{{ route('resources.create') }}" class="group flex flex-col items-center gap-3 p-5 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 hover:border-indigo-300 dark:hover:border-indigo-600/50 hover:shadow-xl hover:shadow-indigo-500/10 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Upload</span>
                </a>
                <a href="{{ route('resources.index') }}" class="group flex flex-col items-center gap-3 p-5 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 hover:border-teal-300 dark:hover:border-teal-600/50 hover:shadow-xl hover:shadow-teal-500/10 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-teal-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Browse</span>
                </a>
                <a href="{{ route('resource-requests.create') }}" class="group flex flex-col items-center gap-3 p-5 bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl border border-slate-200/60 dark:border-slate-700/60 hover:border-amber-300 dark:hover:border-amber-600/50 hover:shadow-xl hover:shadow-amber-500/10 transition-all hover:-translate-y-1">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center text-white shadow-lg shadow-amber-500/30 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-300">Request</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Activity & Stats -->
                <div class="lg:col-span-1 space-y-8">
                    <div data-aos="fade-right" data-aos-delay="100" class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-[2rem] p-8 shadow-sm border border-slate-200/60 dark:border-slate-700/60 hover:shadow-xl transition-all duration-300 group">
                        <div class="flex items-center mb-8">
                             <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-teal-400 to-emerald-600 flex items-center justify-center text-white shadow-lg shadow-teal-500/30 mr-4 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-white">Your Academic Impact</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-6">
                            <!-- Stat Card 1 -->
                            <div data-aos="zoom-in" data-aos-delay="200" class="relative overflow-hidden bg-gradient-to-br from-indigo-500 to-blue-600 p-6 rounded-[2rem] shadow-lg shadow-indigo-500/20 group/card">
                                <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-12 -mt-12 blur-2xl group-hover/card:scale-150 transition-transform duration-700"></div>
                                <div class="relative z-10">
                                    <span class="block text-4xl font-black text-white mb-1 tracking-tighter">{{ $totalUploads }}</span>
                                    <span class="text-xs font-bold text-indigo-100 uppercase tracking-widest opacity-80">Resources Shared</span>
                                </div>
                            </div>
                            
                            <!-- Stat Card 2 -->
                            <div data-aos="zoom-in" data-aos-delay="300" class="relative overflow-hidden bg-gradient-to-br from-violet-500 to-purple-600 p-6 rounded-[2rem] shadow-lg shadow-violet-500/20 group/card">
                                <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-12 -mt-12 blur-2xl group-hover/card:scale-150 transition-transform duration-700"></div>
                                <div class="relative z-10">
                                    <span class="block text-4xl font-black text-white mb-1 tracking-tighter">{{ $totalDownloads }}</span>
                                    <span class="text-xs font-bold text-violet-100 uppercase tracking-widest opacity-80">Collection Downloads</span>
                                </div>
                            </div>

                            <!-- Stat Card 3 (NEW) -->
                            <div data-aos="zoom-in" data-aos-delay="400" class="relative overflow-hidden bg-gradient-to-br from-amber-500 to-orange-600 p-6 rounded-[2rem] shadow-lg shadow-amber-500/20 group/card">
                                <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-12 -mt-12 blur-2xl group-hover/card:scale-150 transition-transform duration-700"></div>
                                <div class="relative z-10">
                                    <span class="block text-4xl font-black text-white mb-1 tracking-tighter">{{ $user->bookmarks ? $user->bookmarks->count() : 0 }}</span>
                                    <span class="text-xs font-bold text-amber-100 uppercase tracking-widest opacity-80">Saved Bookmarks</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Recent Uploads -->
                <div class="lg:col-span-2">
                    <div data-aos="fade-left" data-aos-delay="150" class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-[2rem] p-8 shadow-sm border border-slate-200/60 dark:border-slate-700/60 h-full">
                        <div class="flex justify-between items-center mb-8">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/30 mr-4 hover:scale-110 transition-transform">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 dark:text-white">Recent Uploads</h3>
                            </div>
                            <a href="#" class="px-4 py-2 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-bold transition-colors">View All</a>
                        </div>
                        
                        @if($myResources->isEmpty())
                            <div class="text-center py-16 px-6 bg-slate-50/50 dark:bg-slate-800/50 rounded-2xl border border-dashed border-slate-300 dark:border-slate-600">
                                <div class="w-20 h-20 mx-auto bg-indigo-100 dark:bg-indigo-900/50 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-10 h-10 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                                </div>
                                <h4 class="text-lg font-bold text-slate-800 dark:text-white mb-2">No materials shared yet</h4>
                                <p class="text-slate-500 dark:text-slate-400 mb-6 max-w-sm mx-auto">Start building your academic portfolio by uploading your first study resource.</p>
                                <a href="{{ route('resources.create') }}" class="inline-flex px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition-colors shadow-lg shadow-indigo-500/30">Upload Now</a>
                            </div>
                        @else
                            <div class="space-y-4">
                                @foreach($myResources as $resource)
                                    <div class="group relative flex items-center justify-between p-5 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl hover:border-indigo-300 dark:hover:border-indigo-500/50 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300 hover:-translate-y-1">
                                        <div class="flex items-center overflow-hidden pr-4">
                                            <!-- File Icon -->
                                            <div class="w-12 h-12 flex-shrink-0 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-600 dark:text-orange-400 mr-4 font-black text-xs uppercase tracking-wider">
                                                {{ substr($resource->file_type, 0, 3) }}
                                            </div>
                                            <div class="truncate">
                                                <a href="{{ route('resources.show', $resource) }}" class="text-base font-bold text-slate-800 dark:text-white hover:text-indigo-600 dark:hover:text-indigo-400 truncate block transition-colors">
                                                    {{ $resource->title }}
                                                </a>
                                                <div class="flex items-center mt-1 text-xs font-semibold text-slate-500 dark:text-slate-400 gap-3">
                                                    <span class="flex items-center"><span class="w-2 h-2 rounded-full bg-teal-400 mr-1.5"></span>{{ $resource->course->code ?? 'Course' }}</span>
                                                    <span>{{ $resource->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center flex-shrink-0">
                                            <div class="px-3 py-1.5 bg-slate-100 dark:bg-slate-700 rounded-lg flex items-center text-xs font-bold text-slate-600 dark:text-slate-300">
                                                <svg class="w-3.5 h-3.5 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                {{ $resource->download_count }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
