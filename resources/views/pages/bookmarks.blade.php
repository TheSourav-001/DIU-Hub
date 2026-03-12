<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('My Bookmarks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div data-aos="fade-up" class="bg-white dark:bg-slate-800 p-6 sm:p-10 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-700">
                <div class="flex items-center mb-8 border-b border-slate-100 dark:border-slate-700 pb-4">
                    <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 rounded-2xl mr-4">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-slate-900 dark:text-white">Saved Materials</h3>
                        <p class="text-slate-500 text-sm">Resources you have bookmarked for quick access later.</p>
                    </div>
                </div>

                @if($bookmarks->isEmpty())
                    <div class="text-center py-16" data-aos="fade-in">
                        <svg class="mx-auto h-16 w-16 text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                        <h3 class="text-lg font-medium text-slate-900 dark:text-white">No bookmarks yet</h3>
                        <p class="mt-1 text-slate-500 mb-6">Start exploring to save your favorite study materials.</p>
                        <a href="{{ route('resources.index') }}" class="px-6 py-2 bg-indigo-600 text-white rounded-full font-medium shadow hover:bg-indigo-700 transition">Explore Resources</a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($bookmarks as $index => $bookmark)
                            <div data-aos="fade-up" data-aos-delay="{{ $index * 50 }}" class="bg-slate-50 dark:bg-slate-700/50 rounded-2xl p-6 border border-slate-100 dark:border-slate-600 flex flex-col hover:border-blue-300 dark:hover:border-blue-500 transition-colors group">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="px-3 py-1 bg-white dark:bg-slate-800 text-slate-800 dark:text-slate-300 rounded shadow-sm text-xs font-bold">{{ $bookmark->resource->course->code ?? 'Course' }}</span>
                                    
                                    <form action="{{ route('bookmarks.toggle', $bookmark->resource) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-yellow-500 hover:text-slate-400 transition transform hover:scale-110 active:scale-95" title="Remove Bookmark">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"></path></svg>
                                        </button>
                                    </form>
                                </div>
                                
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white mb-2 line-clamp-2">{{ $bookmark->resource->title }}</h4>
                                <p class="text-sm text-slate-500 dark:text-slate-400 line-clamp-2 mb-4 flex-grow">{{ $bookmark->resource->description }}</p>
                                
                                <div class="mt-auto flex justify-between items-center text-sm pt-4 border-t border-slate-200 dark:border-slate-600">
                                    <span class="font-medium text-slate-500 uppercase text-xs">{{ $bookmark->resource->file_type }}</span>
                                    <a href="{{ route('resources.show', $bookmark->resource) }}" class="text-blue-600 dark:text-blue-400 font-semibold group-hover:underline">Access &rarr;</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8">
                        {{ $bookmarks->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
