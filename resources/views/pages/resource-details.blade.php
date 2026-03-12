<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Resource Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up" class="bg-white dark:bg-slate-800 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700 overflow-hidden">
                <!-- Header Banner -->
                <div class="bg-gradient-to-br from-indigo-50 to-violet-50 dark:from-indigo-950/50 dark:to-violet-950/50 p-6 sm:p-10 border-b border-slate-100 dark:border-slate-700">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-3 py-1 bg-indigo-600 text-white rounded-lg text-xs font-bold tracking-wider">{{ $resource->course->code ?? 'N/A' }}</span>
                        <span class="text-sm font-medium text-slate-500">{{ $resource->course->department->name ?? '' }}</span>
                    </div>
                    
                    <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-4">{{ $resource->title }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-6 text-sm text-slate-600 dark:text-slate-400 font-medium pb-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Uploaded by {{ $resource->user->name }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ explode(' ', $resource->created_at)[0] }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            {{ strtoupper($resource->file_type) }} ({{ round($resource->file_size / 1024 / 1024, 2) }} MB)
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="p-6 sm:p-10">
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            Description
                        </h3>
                        <p class="text-slate-600 dark:text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $resource->description ?: 'No description provided.' }}</p>
                    </div>

                    @if($resource->tags->count() > 0)
                    <div class="mb-8 border-t border-slate-100 dark:border-slate-700 pt-6">
                        <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($resource->tags as $tag)
                                <a href="{{ route('resources.index', ['tag' => $tag->name]) }}" class="px-3 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 rounded-full text-xs font-medium border border-slate-200 dark:border-slate-600 hover:bg-slate-200 dark:hover:bg-slate-600 transition-colors">#{{ $tag->name }}</a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(in_array(strtolower($resource->file_type), ['png', 'jpg', 'jpeg']))
                    <div class="mb-8 border-t border-slate-100 dark:border-slate-700 pt-6">
                        <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400 mb-4 uppercase tracking-wider">Image Preview</h3>
                        <div class="bg-slate-100 dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 p-2 flex justify-center">
                            <img src="{{ route('resources.preview', $resource) }}" loading="lazy" alt="Preview of {{ $resource->title }}" class="max-h-96 object-contain rounded-xl shadow-sm">
                        </div>
                    </div>
                    @endif

                    @if(strtolower($resource->file_type) === 'pdf')
                    <div class="mb-8 border-t border-slate-100 dark:border-slate-700 pt-6">
                        <h3 class="text-sm font-semibold text-slate-500 dark:text-slate-400 mb-4 uppercase tracking-wider flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6zM6 20V4h7v5h5v11H6z"/></svg>
                            PDF Preview
                        </h3>
                        <div class="bg-slate-100 dark:bg-slate-900 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700">
                            <iframe src="{{ route('resources.preview', $resource) }}" class="w-full rounded-2xl h-[50vh] sm:h-[600px]" loading="lazy"></iframe>
                        </div>
                    </div>
                    @endif

                    <div class="flex flex-col items-stretch gap-4 pt-8 border-t border-slate-100 dark:border-slate-700">
                        <div class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 sm:gap-4 w-full" x-data="{ 
                            bookmarked: {{ $isBookmarked ? 'true' : 'false' }},
                            loading: false,
                            async toggleBookmark() {
                                if (this.loading) return;
                                this.loading = true;
                                try {
                                    const response = await fetch('{{ route('bookmarks.toggle', $resource) }}', {
                                        method: 'POST',
                                        headers: {
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                            'Accept': 'application/json',
                                            'Content-Type': 'application/json'
                                        }
                                    });
                                    const data = await response.json();
                                    this.bookmarked = data.bookmarked;

                                    // Bounce animation on the bookmark icon
                                    const icon = this.$refs.bookmarkIcon;
                                    icon.classList.remove('bookmark-bounce');
                                    void icon.offsetWidth; // force reflow
                                    icon.classList.add('bookmark-bounce');
                                    
                                    // Dispatch toast event
                                    window.dispatchEvent(new CustomEvent('toast', { 
                                        detail: { message: data.message } 
                                    }));
                                } catch (e) {
                                    alert('Something went wrong. Please try again.');
                                } finally {
                                    this.loading = false;
                                }
                            }
                        }">
                            <!-- Download Button (Signed URL - expires in 60 min) -->
                            <a href="{{ \Illuminate\Support\Facades\URL::temporarySignedRoute('resources.download', now()->addMinutes(60), ['resource' => $resource]) }}" class="w-full sm:w-auto px-6 sm:px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl font-bold shadow-lg shadow-blue-500/30 transition-all flex items-center justify-center hover:-translate-y-0.5 active:scale-95">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Download Material
                            </a>

                            <!-- Bookmark Button -->
                            @auth
                            <button @click="toggleBookmark()" :class="bookmarked ? 'bg-yellow-50 text-yellow-600 border-yellow-200 shadow-yellow-100' : 'bg-slate-50 text-slate-600 border-slate-200'" class="w-full sm:w-auto px-6 sm:px-8 py-4 border-2 rounded-2xl font-bold transition-all flex items-center justify-center gap-2 hover:shadow-lg disabled:opacity-50" :disabled="loading">
                                <svg x-ref="bookmarkIcon" class="w-6 h-6 transition-transform" :class="bookmarked ? 'scale-110' : ''" :fill="bookmarked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                                <span x-text="bookmarked ? 'Bookmarked' : 'Bookmark'"></span>
                            </button>
                            @else
                            <a href="{{ route('login') }}" class="w-full sm:w-auto px-6 sm:px-8 py-4 bg-slate-50 text-slate-600 border-2 border-slate-200 rounded-2xl font-bold transition-all flex items-center justify-center gap-2 hover:bg-slate-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                </svg>
                                <span>Bookmark</span>
                            </a>
                            @endauth
                            
                            <!-- Stats Badge -->
                            <div class="w-full sm:w-auto px-4 py-3 bg-slate-50 dark:bg-slate-700/50 rounded-2xl text-slate-600 dark:text-slate-300 font-medium flex items-center justify-center border border-slate-100 dark:border-slate-700">
                                <svg class="w-5 h-5 mr-1.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                {{ $resource->download_count }} Downloads
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recommendation System -->
            @if(isset($relatedResources) && $relatedResources->count() > 0)
            <div class="mt-16 mb-8" data-aos="fade-up">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-6 border-l-4 border-blue-500 pl-4">Related Materials</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedResources as $index => $related)
                        <div data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 hover:shadow-md transition-shadow group">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $related->file_type }}</span>
                                <div class="flex items-center text-xs font-medium text-slate-500">
                                    <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    {{ $related->download_count }}
                                </div>
                            </div>
                            <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">{{ $related->title }}</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 line-clamp-2 max-h-10">{{ $related->description }}</p>
                            <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-700">
                                <a href="{{ route('resources.show', $related) }}" class="text-sm font-semibold text-blue-600 dark:text-blue-400 hover:underline">View Material &rarr;</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
            
        </div>
    </div>
</x-app-layout>
