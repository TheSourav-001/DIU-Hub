<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Request a Resource') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up" class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden shadow-2xl shadow-indigo-500/10 sm:rounded-[2rem] p-8 sm:p-12 relative group">
                <!-- Decorative background elements -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-700"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-violet-500/10 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-700 delay-100"></div>

                <div class="relative z-10 mb-8">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-400 to-orange-600 flex items-center justify-center text-white shadow-lg shadow-orange-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-extrabold text-slate-900 dark:text-white tracking-tight">Request a Study Resource</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm">Can't find what you need? Tell us and we'll notify you when it's uploaded.</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('resource-requests.store') }}" class="relative z-10">
                    @csrf
                    
                    <div class="space-y-8">
                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">What resource are you looking for?</label>
                            <input id="title" type="text" name="title" value="{{ old('title') }}" required
                                class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md font-medium"
                                placeholder="e.g. Operating Systems Midterm Questions Spring 2025">
                            @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Department -->
                            <div>
                                <label for="department" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Department</label>
                                <select id="department" name="department" required
                                    class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md">
                                    <option value="">Select Department</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->name }}" {{ old('department') == $dept->name ? 'selected' : '' }}>{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                                @error('department') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Course Code -->
                            <div>
                                <label for="course_code" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Course Code</label>
                                <input id="course_code" type="text" name="course_code" value="{{ old('course_code') }}" required
                                    class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md uppercase font-mono font-bold"
                                    placeholder="e.g. CSE311">
                                @error('course_code') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Semester -->
                            <div>
                                <label for="semester" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Semester</label>
                                <select id="semester" name="semester" required
                                    class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md">
                                    <option value="">Select Semester</option>
                                    @for($year = 2026; $year >= 2022; $year--)
                                        <option value="Spring {{ $year }}" {{ old('semester') == "Spring $year" ? 'selected' : '' }}>Spring {{ $year }}</option>
                                        <option value="Summer {{ $year }}" {{ old('semester') == "Summer $year" ? 'selected' : '' }}>Summer {{ $year }}</option>
                                        <option value="Fall {{ $year }}" {{ old('semester') == "Fall $year" ? 'selected' : '' }}>Fall {{ $year }}</option>
                                    @endfor
                                </select>
                                @error('semester') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <!-- Resource Type -->
                            <div>
                                <label for="resource_type" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Resource Type</label>
                                <select id="resource_type" name="resource_type" required
                                    class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md">
                                    <option value="">Select Type</option>
                                    <option value="Quiz" {{ old('resource_type') == 'Quiz' ? 'selected' : '' }}>Quiz</option>
                                    <option value="Midterm" {{ old('resource_type') == 'Midterm' ? 'selected' : '' }}>Midterm</option>
                                    <option value="Final" {{ old('resource_type') == 'Final' ? 'selected' : '' }}>Final</option>
                                    <option value="Notes" {{ old('resource_type') == 'Notes' ? 'selected' : '' }}>Notes</option>
                                    <option value="Slide" {{ old('resource_type') == 'Slide' ? 'selected' : '' }}>Slide</option>
                                    <option value="Assignment" {{ old('resource_type') == 'Assignment' ? 'selected' : '' }}>Assignment</option>
                                    <option value="Other" {{ old('resource_type') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('resource_type') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 ml-1">Additional Details <span class="text-slate-400 font-normal">(optional)</span></label>
                            <textarea id="description" name="description" rows="4"
                                class="block w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md resize-none"
                                placeholder="Describe what specific content you need...">{{ old('description') }}</textarea>
                            @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ route('resource-requests.index') }}" class="text-sm font-bold text-slate-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">← My Requests</a>
                            <button type="submit"
                                class="px-10 py-4 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-2xl font-extrabold text-base shadow-xl shadow-indigo-500/25 hover:shadow-2xl hover:shadow-indigo-500/40 transition-all hover:-translate-y-0.5 active:scale-95 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                Submit Request
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
