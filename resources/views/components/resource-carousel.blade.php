@props(['title', 'resources', 'id' => 'carousel-' . Str::random(8)])

<div class="py-12" x-data="{ 
    scroll: 0,
    maxScroll: 0,
    updateScroll() {
        this.scroll = this.$refs.container.scrollLeft;
        this.maxScroll = this.$refs.container.scrollWidth - this.$refs.container.clientWidth;
    }
}" x-init="setTimeout(() => updateScroll(), 500)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-8" data-aos="fade-up">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">{{ $title }}</h2>
                <div class="h-1 w-12 bg-indigo-600 rounded-full mt-2"></div>
            </div>
            
            <!-- Navigation Buttons -->
            <div class="flex gap-2">
                <button @click="$refs.container.scrollBy({ left: -300, behavior: 'smooth' })" 
                    class="p-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 transition-all active:scale-90 disabled:opacity-50"
                    :disabled="scroll <= 5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button @click="$refs.container.scrollBy({ left: 300, behavior: 'smooth' })" 
                    class="p-3 rounded-xl bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-300 transition-all active:scale-90 disabled:opacity-50"
                    :disabled="scroll >= maxScroll - 5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>

        <!-- Carousel Container -->
        <div class="relative group">
            <div x-ref="container" @scroll.debounce.50ms="updateScroll()"
                class="flex gap-6 overflow-x-auto pb-8 snap-x snap-mandatory no-scrollbar scroll-smooth">
                @forelse($resources as $resource)
                    <div class="flex-none w-[300px] sm:w-[350px] snap-start" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <a href="{{ route('resources.show', $resource) }}" class="block group/card h-full">
                            <div class="bg-white dark:bg-slate-800 rounded-[2rem] border border-slate-100 dark:border-slate-700/50 p-5 shadow-sm hover:shadow-2xl hover:shadow-indigo-500/10 transition-all duration-500 transform group-hover/card:-translate-y-2 flex flex-col h-full">
                                
                                <!-- Preview Image / Thumbnail -->
                                <div class="relative w-full aspect-video rounded-3xl overflow-hidden mb-5 bg-gradient-to-br from-indigo-50 to-violet-50 dark:from-indigo-900/20 dark:to-violet-900/20 flex items-center justify-center border border-slate-100 dark:border-slate-700/30">
                                    @if(in_array(strtolower($resource->file_type), ['png', 'jpg', 'jpeg']))
                                        <img src="{{ route('resources.preview', $resource) }}" loading="lazy" alt="{{ $resource->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover/card:scale-110">
                                    @else
                                        <div class="w-16 h-16 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-white dark:border-slate-700 flex items-center justify-center group-hover/card:rotate-6 group-hover/card:scale-110 transition-all duration-500">
                                            <span class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-br from-indigo-600 to-violet-600 uppercase tracking-tighter">{{ $resource->file_type }}</span>
                                        </div>
                                    @endif
                                    
                                    <div class="absolute top-3 right-3 px-3 py-1 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md rounded-full text-[10px] font-black uppercase text-slate-600 dark:text-slate-300 border border-white/20 dark:border-slate-700/50 shadow-sm">
                                        {{ $resource->file_type }}
                                    </div>
                                </div>

                                <!-- Metadata -->
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-3 py-1 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg text-[10px] font-black uppercase tracking-wider">{{ $resource->course->code ?? 'COURSE' }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500">•</span>
                                    <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 truncate">{{ $resource->course->department->name ?? 'Dept.' }}</span>
                                </div>

                                <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 line-clamp-1 group-hover/card:text-indigo-600 dark:group-hover/card:text-indigo-400 transition-colors">{{ $resource->title }}</h3>
                                
                                <div class="mt-auto flex items-center justify-between pt-4 border-t border-slate-50 dark:border-slate-700/50">
                                    <div class="flex items-center gap-1.5">
                                        @php $avgRating = $resource->ratings && $resource->ratings->count() > 0 ? round($resource->ratings->avg('rating'), 1) : 0; @endphp
                                        @if($avgRating > 0)
                                            <div class="flex text-amber-400">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <svg class="w-3.5 h-3.5" fill="{{ $i <= round($avgRating) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="{{ $i <= round($avgRating) ? '0' : '1.5' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                                @endfor
                                            </div>
                                            <span class="text-xs font-bold text-slate-400">{{ $avgRating }}</span>
                                        @else
                                            <span class="px-2 py-0.5 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-500 dark:text-indigo-400 rounded-md text-[10px] font-black uppercase tracking-wider">New</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-1.5 text-xs font-bold text-slate-500">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        {{ $resource->download_count }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="w-full text-center py-10">
                        <p class="text-slate-500 font-medium">No resources found in this category.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
