<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('My Resource Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Card -->
            <div data-aos="fade-down" class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
                <div>
                    <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Your Requests</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Track resources you've requested. We'll notify you when they're uploaded.</p>
                </div>
                <a href="{{ route('resource-requests.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:-translate-y-0.5 transition-all active:scale-95 gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    New Request
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/40 rounded-2xl text-emerald-700 dark:text-emerald-400 text-sm font-medium">
                    {{ session('success') }}
                </div>
            @endif

            @if($requests->isEmpty())
                <div data-aos="fade-up" class="text-center py-20 bg-white/80 dark:bg-slate-800/80 rounded-[2rem] border border-slate-200/50 dark:border-slate-700/50 backdrop-blur-xl">
                    <div class="w-20 h-20 mx-auto bg-amber-100 dark:bg-amber-900/30 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">No requests yet</h3>
                    <p class="text-slate-500 dark:text-slate-400 mb-6 max-w-sm mx-auto">Can't find a resource? Request it and the community will help.</p>
                    <a href="{{ route('resource-requests.create') }}" class="inline-flex px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl font-bold transition-colors shadow-lg shadow-indigo-500/30">Request a Resource</a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($requests as $index => $req)
                        <div data-aos="fade-up" data-aos-delay="{{ $index * 50 }}" class="group bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl rounded-2xl p-6 border border-slate-200/60 dark:border-slate-700/60 hover:border-indigo-300 dark:hover:border-indigo-600/50 hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-300">
                            <div class="flex flex-col sm:flex-row justify-between gap-4">
                                <div class="flex-grow">
                                    <div class="flex items-center gap-3 mb-2">
                                        <h4 class="text-lg font-bold text-slate-900 dark:text-white">{{ $req->title }}</h4>
                                        @if($req->status === 'pending')
                                            <span class="px-2.5 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 rounded-lg text-xs font-bold uppercase tracking-wider">Pending</span>
                                        @else
                                            <span class="px-2.5 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-lg text-xs font-bold uppercase tracking-wider">Fulfilled</span>
                                        @endif
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500 dark:text-slate-400">
                                        <span class="flex items-center gap-1.5">
                                            <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                                            {{ $req->course_code }}
                                        </span>
                                        <span>{{ $req->department }}</span>
                                        <span>{{ $req->semester }}</span>
                                        <span class="px-2 py-0.5 bg-slate-100 dark:bg-slate-700 rounded text-xs font-bold">{{ $req->resource_type }}</span>
                                    </div>
                                    @if($req->description)
                                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400 line-clamp-2">{{ $req->description }}</p>
                                    @endif
                                </div>
                                <div class="text-sm text-slate-400 dark:text-slate-500 font-medium whitespace-nowrap">
                                    {{ $req->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
