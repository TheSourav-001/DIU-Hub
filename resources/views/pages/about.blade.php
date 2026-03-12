<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('About Daffodil International University') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div data-aos="fade-up" class="relative overflow-hidden rounded-[3rem] bg-indigo-900 shadow-2xl mb-16">
                <img src="{{ asset('images/hero/about_hero.png') }}" alt="DIU Campus" class="absolute inset-0 w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-900 via-indigo-900/80 to-transparent"></div>
                
                <div class="relative z-10 p-12 lg:p-20 lg:w-2/3">
                    <h1 class="text-4xl lg:text-6xl font-black text-white mb-6 leading-tight">Empowering the <span class="text-teal-400">Next Generation</span> of Leaders</h1>
                    <p class="text-indigo-100 text-lg lg:text-xl font-medium mb-8 leading-relaxed">
                        Daffodil International University (DIU) is a top-ranked private university in Bangladesh, recognized globally for its commitment to excellence in education, research, and innovation.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <div class="px-6 py-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 text-white font-bold">QS World Ranked</div>
                        <div class="px-6 py-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 text-white font-bold">UI GreenMetric #1</div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
                @foreach([
                    ['label' => 'Faculties', 'value' => '5+'],
                    ['label' => 'Departments', 'value' => '30+'],
                    ['label' => 'Students', 'value' => '20K+'],
                    ['label' => 'Campus Size', 'value' => '100+ Acre']
                ] as $stat)
                    <div data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}" class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl p-8 rounded-[2rem] border border-slate-200/50 dark:border-slate-700/50 text-center shadow-sm hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="text-3xl lg:text-4xl font-black text-indigo-600 dark:text-indigo-400 mb-2">{{ $stat['value'] }}</div>
                        <div class="text-sm font-bold text-slate-500 uppercase tracking-widest">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>

            <!-- Mission & Vision -->
            <div class="grid lg:grid-cols-2 gap-12">
                <div data-aos="fade-right" class="bg-gradient-to-br from-indigo-600 to-indigo-800 p-12 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden group">
                    <div class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-700"></div>
                    <h3 class="text-3xl font-black mb-6 flex items-center gap-3">
                        <svg class="w-8 h-8 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Our Mission
                    </h3>
                    <p class="text-indigo-100 text-lg leading-relaxed font-medium">
                        To provide quality education at an affordable cost, and to produce skilled human resources who can contribute to the national and global economy through innovation and ethical leadership.
                    </p>
                </div>
                <div data-aos="fade-left" class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-xl p-12 rounded-[2.5rem] border border-slate-200/50 dark:border-slate-700/50 shadow-xl group">
                    <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-6 flex items-center gap-3">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Our Vision
                    </h3>
                    <p class="text-slate-500 dark:text-slate-400 text-lg leading-relaxed font-medium">
                        To become one of the leading universities in the world by fostering a culture of research, entrepreneurship, and sustainable development.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
