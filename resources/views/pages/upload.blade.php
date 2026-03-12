<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Upload Study Material') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div data-aos="fade-up" class="bg-white/90 dark:bg-slate-800/90 backdrop-blur-xl border border-slate-200/50 dark:border-slate-700/50 overflow-hidden shadow-2xl shadow-indigo-500/10 sm:rounded-[2rem] p-8 sm:p-12 relative group">
                <!-- Decorative background elements -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-700"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-violet-500/10 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-700 delay-100"></div>

                <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data" class="relative z-10">
                    @csrf
                    
                    <div class="space-y-8">
                        <!-- Title -->
                        <div>
                            <x-input-label for="title" :value="__('Resource Title')" class="text-slate-700 dark:text-slate-300 font-bold mb-2 ml-1" />
                            <x-text-input id="title" class="block mt-1 w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md" type="text" name="title" :value="old('title')" required autofocus placeholder="e.g. Operating Systems Final Review Notes" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Department -->
                            <div>
                                <x-input-label for="department_id" :value="__('Department')" class="text-slate-700 dark:text-slate-300 font-bold mb-2 ml-1" />
                                <select id="department_id" name="department_id" class="block mt-1 w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md" required>
                                    <option value="" disabled selected>Select Department</option>
                                    @php $currentFaculty = ''; @endphp
                                    @foreach($departments as $dept)
                                        @if($currentFaculty !== $dept->faculty)
                                            @if($currentFaculty !== '') </optgroup> @endif
                                            @php $currentFaculty = $dept->faculty; @endphp
                                            <optgroup label="{{ $currentFaculty }}" class="font-bold text-indigo-600">
                                        @endif
                                        <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                                    @endforeach
                                    </optgroup>
                                </select>
                                <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                            </div>

                            <!-- Course Code -->
                            <div>
                                <x-input-label for="course_code" :value="__('Course Code')" class="text-slate-700 dark:text-slate-300 font-bold mb-2 ml-1" />
                                <x-text-input id="course_code" class="block mt-1 w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md uppercase" type="text" name="course_code" :value="old('course_code')" required placeholder="e.g. CSE411" />
                                <x-input-error :messages="$errors->get('course_code')" class="mt-2" />
                            </div>

                            <!-- Semester -->
                            <div>
                                <x-input-label for="semester" :value="__('Semester')" class="text-slate-700 dark:text-slate-300 font-bold mb-2 ml-1" />
                                <select id="semester" name="semester" class="block mt-1 w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md" required>
                                    <option value="" disabled selected>Select Semester</option>
                                    @for($year = 2026; $year >= 2022; $year--)
                                        <option value="Spring {{ $year }}">Spring {{ $year }}</option>
                                        <option value="Summer {{ $year }}">Summer {{ $year }}</option>
                                        <option value="Fall {{ $year }}">Fall {{ $year }}</option>
                                    @endfor
                                </select>
                                <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Exam Type -->
                            <div>
                                <x-input-label for="exam_type" :value="__('Exam Type')" class="text-slate-700 dark:text-slate-300 font-bold mb-2 ml-1" />
                                <select id="exam_type" name="exam_type" class="block mt-1 w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md" required>
                                    <option value="" disabled selected>Select Exam Type</option>
                                    <option value="Quiz">Quiz</option>
                                    <option value="Midterm">Midterm</option>
                                    <option value="Final">Final</option>
                                    <option value="Other">Other / Not an Exam</option>
                                </select>
                                <x-input-error :messages="$errors->get('exam_type')" class="mt-2" />
                            </div>

                            <!-- Tags -->
                            <div>
                                <x-input-label for="tags" :value="__('Tags (Comma separated)')" class="text-slate-700 dark:text-slate-300 font-bold mb-2 ml-1" />
                                <x-text-input id="tags" class="block mt-1 w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md" type="text" name="tags" :value="old('tags')" placeholder="e.g. midterm, algorithms" />
                                <x-input-error :messages="$errors->get('tags')" class="mt-2 text-indigo-400" />
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <x-input-label for="description" :value="__('Description (Optional)')" class="text-slate-700 dark:text-slate-300 font-bold mb-2 ml-1" />
                            <textarea id="description" name="description" rows="4" class="block mt-1 w-full px-5 py-4 rounded-2xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 text-slate-700 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition-all focus:shadow-md" placeholder="Add contextual information about these materials...">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- File Upload -->
                        <div class="mt-4" x-data="{
                            dragging: false,
                            fileName: '',
                            fileSize: '',
                            handleDrop(e) {
                                this.dragging = false;
                                const file = e.dataTransfer.files[0];
                                if (file) {
                                    document.getElementById('file').files = e.dataTransfer.files;
                                    this.fileName = file.name;
                                    this.fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                                }
                            },
                            handleSelect(e) {
                                const file = e.target.files[0];
                                if (file) {
                                    this.fileName = file.name;
                                    this.fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                                }
                            }
                        }">
                            <x-input-label for="file" :value="__('Upload File (Max 20MB)')" class="text-slate-700 dark:text-slate-300 font-bold mb-2 ml-1" />
                            <div class="mt-2 flex justify-center px-6 pt-10 pb-12 border-2 border-dashed rounded-3xl transition-all duration-300 cursor-pointer shadow-inner relative overflow-hidden group"
                                :class="dragging ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20 scale-[1.02] shadow-indigo-500/20' : 'border-indigo-200 dark:border-indigo-800/50 bg-indigo-50/50 dark:bg-indigo-900/10 hover:bg-white dark:hover:bg-slate-800'"
                                @dragenter.prevent="dragging = true"
                                @dragover.prevent="dragging = true"
                                @dragleave.prevent="dragging = false"
                                @drop.prevent="handleDrop($event)"
                                @click="$refs.fileInput.click()">
                                <div class="space-y-3 text-center z-10">
                                    <div class="w-20 h-20 mx-auto bg-white dark:bg-slate-800 rounded-full shadow-lg border border-slate-100 dark:border-slate-700 flex items-center justify-center transition-transform duration-300" :class="dragging ? '-translate-y-4 scale-110' : 'group-hover:-translate-y-2'">
                                        <svg class="mx-auto h-10 w-10 text-indigo-500" :class="dragging ? 'animate-bounce' : ''" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </div>
                                    <div class="flex flex-col text-sm text-slate-600 dark:text-slate-400 justify-center">
                                        <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400" x-text="dragging ? 'Drop your file here!' : 'Select a file'"></span>
                                        <p class="pt-1" x-show="!dragging">or drag and drop it here</p>
                                    </div>
                                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-widest pt-2" x-show="!fileName">
                                        All formats supported up to 20MB
                                    </p>
                                    <div class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-full" x-show="fileName" x-cloak>
                                        <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                        <p class="text-sm font-bold text-indigo-800 dark:text-indigo-300" x-text="fileName"></p>
                                        <span class="ml-2 text-xs font-medium text-indigo-500" x-text="'(' + fileSize + ')'"></span>
                                    </div>
                                    <input id="file" name="file" type="file" class="sr-only" x-ref="fileInput" required @change="handleSelect($event)">
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('file')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-12 pt-8 border-t border-slate-100 dark:border-slate-700/50">
                            <a href="{{ route('dashboard') }}" class="text-sm font-bold text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white mr-8 transition-colors">
                                Cancel
                            </a>
                            <button type="submit" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-violet-600 rounded-xl font-bold text-white shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:-translate-y-0.5 transition-all duration-300 w-full sm:w-auto text-lg flex items-center justify-center gap-2 relative overflow-hidden group/btn">
                                <span class="relative z-10">Upload Material</span>
                                <svg class="w-5 h-5 relative z-10 group-hover/btn:translate-x-1 group-hover/btn:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                <div class="absolute inset-0 h-full w-full bg-white/20 scale-x-0 group-hover/btn:scale-x-100 transition-transform origin-left duration-300 ease-out z-0"></div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
