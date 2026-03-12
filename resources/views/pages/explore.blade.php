<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Resource Explorer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Minimalist Filter Section -->
            <div class="mb-12" data-aos="fade-down">
                <form action="{{ route('resources.index') }}" method="GET" class="space-y-6" x-data x-ref="filterForm">
                    <!-- Search Field - High Focus -->
                    <div class="relative max-w-3xl mx-auto group">
                        <!-- Left Icon -->
                        <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-slate-400 group-focus-within:text-indigo-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        
                        <!-- Input Field -->
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                            class="block w-full pl-16 pr-32 py-5 bg-white dark:bg-slate-800 border-2 border-slate-100 dark:border-slate-700 rounded-3xl text-slate-900 dark:text-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all shadow-sm font-bold text-lg placeholder-slate-400" 
                            placeholder="What are you looking for today?">

                        <!-- Right Actions -->
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 gap-2">
                            <button type="submit" class="p-2.5 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-500/20 active:scale-95 group/search">
                                <svg class="w-5 h-5 group-hover/search:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                            </button>
                            <a href="{{ route('resources.index') }}" class="p-2.5 bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-2xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-all active:scale-95 group/clear">
                                <svg class="w-5 h-5 group-hover/clear:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" /></svg>
                            </a>
                        </div>
                    </div>

                    <!-- Refined Filter Grid -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 max-w-5xl mx-auto">
                        <!-- Dept -->
                        <div class="relative">
                            <select name="department_id" @change="$refs.filterForm.submit()" class="w-full pl-4 pr-10 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-sm font-bold text-slate-600 dark:text-slate-300 appearance-none focus:ring-2 focus:ring-indigo-500/20 cursor-pointer transition-all">
                                <option value="">All Departments</option>
                                @php $currentFaculty = ''; @endphp
                                @foreach($departments as $dept)
                                    @if($currentFaculty !== $dept->faculty)
                                        @if($currentFaculty !== '') </optgroup> @endif
                                        @php $currentFaculty = $dept->faculty; @endphp
                                        <optgroup label="{{ $currentFaculty }}" class="text-indigo-600">
                                    @endif
                                    <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                @endforeach
                                </optgroup>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>

                        <!-- Code -->
                        <div class="relative">
                            <input type="text" name="course_code" value="{{ request('course_code') }}" 
                                class="w-full px-4 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-sm font-bold text-slate-600 dark:text-slate-300 focus:ring-2 focus:ring-indigo-500/20 uppercase placeholder-slate-400" 
                                placeholder="Code (CSE411)">
                        </div>

                        <!-- Semester -->
                        <div class="relative">
                            <select name="semester" @change="$refs.filterForm.submit()" class="w-full pl-4 pr-10 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-sm font-bold text-slate-600 dark:text-slate-300 appearance-none focus:ring-2 focus:ring-indigo-500/20 cursor-pointer transition-all">
                                <option value="">Any Semester</option>
                                @for($year = 2026; $year >= 2022; $year--)
                                    <option value="Spring {{ $year }}" {{ request('semester') == "Spring $year" ? 'selected' : '' }}>Spring {{ $year }}</option>
                                    <option value="Summer {{ $year }}" {{ request('semester') == "Summer $year" ? 'selected' : '' }}>Summer {{ $year }}</option>
                                    <option value="Fall {{ $year }}" {{ request('semester') == "Fall $year" ? 'selected' : '' }}>Fall {{ $year }}</option>
                                @endfor
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>

                        <!-- Type -->
                        <div class="relative">
                            <select name="exam_type" @change="$refs.filterForm.submit()" class="w-full pl-4 pr-10 py-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-2xl text-sm font-bold text-slate-600 dark:text-slate-300 appearance-none focus:ring-2 focus:ring-indigo-500/20 cursor-pointer transition-all">
                                <option value="">Any Type</option>
                                <option value="Quiz" {{ request('exam_type') == 'Quiz' ? 'selected' : '' }}>Quiz</option>
                                <option value="Midterm" {{ request('exam_type') == 'Midterm' ? 'selected' : '' }}>Midterm</option>
                                <option value="Final" {{ request('exam_type') == 'Final' ? 'selected' : '' }}>Final</option>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Resource Grid -->
            @if($resources->isEmpty())
                <div class="text-center py-20 bg-white dark:bg-slate-800 rounded-3xl border border-slate-100 dark:border-slate-700">
                    <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path></svg>
                    <h3 class="mt-4 text-lg font-medium text-slate-900 dark:text-white">No materials found</h3>
                    <p class="mt-1 text-slate-500">Didn't find what you're looking for? Request this resource.</p>
                    @auth
                        <a href="{{ route('resource-requests.create') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:-translate-y-0.5 transition-all active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Request Resource
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 rounded-2xl font-bold hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                            Log in to Request Resource
                        </a>
                    @endauth
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($resources as $resource)
                        <div class="group relative bg-white dark:bg-slate-800 rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:shadow-indigo-500/20 transition-all duration-500 border border-slate-200/60 dark:border-slate-700/60 flex flex-col overflow-hidden hover:-translate-y-3" data-aos="zoom-in-up">
                            <!-- Premium Header/Thumbnail -->
                            <div class="h-48 w-full bg-gradient-to-br from-slate-50 to-indigo-50 dark:from-slate-900 dark:to-indigo-950 relative overflow-hidden flex items-center justify-center border-b border-slate-100 dark:border-slate-800/50">
                                @if(in_array(strtolower($resource->file_type), ['png', 'jpg', 'jpeg']))
                                    <img src="{{ route('resources.preview', $resource) }}" loading="lazy" alt="{{ $resource->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <!-- Animated Background Elements -->
                                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-indigo-500/5 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                                    <div class="absolute -right-12 -top-12 w-48 h-48 bg-indigo-500/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                                    <div class="absolute -left-12 -bottom-12 w-48 h-48 bg-violet-500/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000 delay-200"></div>

                                    <div class="relative z-10 w-20 h-20 bg-white dark:bg-slate-800 rounded-3xl shadow-2xl border border-white dark:border-slate-700 flex items-center justify-center group-hover:rotate-12 group-hover:scale-110 transition-all duration-500">
                                        <span class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-br from-indigo-600 to-violet-600 uppercase tracking-tighter">{{ $resource->file_type }}</span>
                                    </div>
                                @endif
                                
                                <!-- Floating Indicator -->
                                <div class="absolute top-6 left-6 flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></div>
                                    <span class="text-[10px] font-black text-indigo-500 uppercase tracking-widest">{{ $resource->exam_type }}</span>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-8 flex-grow flex flex-col">
                                <div class="flex items-center gap-3 mb-6">
                                    <span class="px-4 py-1.5 bg-indigo-600 text-white rounded-xl text-[10px] font-black tracking-widest shadow-lg shadow-indigo-500/30">
                                        {{ $resource->course->code ?? 'DIU' }}
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $resource->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                
                                <h3 class="text-2xl font-black text-slate-800 dark:text-white mb-3 leading-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors line-clamp-2">
                                    {{ $resource->title }}
                                </h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm mb-8 line-clamp-2 font-medium leading-relaxed">
                                    {{ $resource->description }}
                                </p>
                                
                                <div class="mt-auto space-y-6">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($resource->tags->take(3) as $tag)
                                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 rounded-lg text-[9px] font-black uppercase tracking-widest border border-slate-200/50 dark:border-slate-700/50">
                                                #{{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>

                                    <div class="flex items-center justify-between pt-6 border-t border-slate-100 dark:border-slate-800/50">
                                        <div class="flex items-center gap-4">
                                            <div class="flex items-center text-[10px] font-black text-slate-400 bg-slate-50 dark:bg-slate-900/50 px-3 py-1.5 rounded-xl">
                                                <svg class="w-4 h-4 mr-1.5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                {{ $resource->download_count }}
                                            </div>
                                        </div>
                                        
                                        <a href="{{ route('resources.show', $resource) }}" class="group/btn relative overflow-hidden px-6 py-2.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-2xl text-xs font-black tracking-widest hover:shadow-2xl shadow-indigo-500/20 transition-all flex items-center justify-center gap-2">
                                            <span class="relative z-10">EXPLORE</span>
                                            <svg class="w-3.5 h-3.5 relative z-10 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8">
                    {{ $resources->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
