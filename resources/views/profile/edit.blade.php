<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 dark:text-slate-200 leading-tight">
            {{ __('Student Profile') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ activeTab: 'personal' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Profile Overview Header -->
            <div class="bg-gradient-to-br from-indigo-900 via-indigo-800 to-violet-900 rounded-[2.5rem] p-8 sm:p-10 shadow-2xl relative overflow-hidden group">
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-gradient-to-br from-teal-400/20 to-indigo-400/20 rounded-full blur-3xl pointer-events-none group-hover:scale-110 transition-transform duration-700"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="flex flex-col sm:flex-row items-center gap-8 text-center sm:text-left">
                        <div class="relative group">
                            <div class="w-32 h-32 rounded-[2.5rem] bg-white/10 backdrop-blur-md border-2 border-white/20 overflow-hidden shadow-2xl relative z-10 group-hover:-translate-y-2 transition-transform duration-500">
                                @php
                                    $avatarPath = $profile->avatar;
                                    $fileExists = $avatarPath && file_exists(storage_path('app/public/' . $avatarPath));
                                @endphp
                                @if($avatarPath && $fileExists)
                                    <img src="{{ asset('storage/' . $avatarPath) }}" alt="Avatar" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-5xl font-black text-white">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="absolute inset-0 bg-indigo-400 rounded-[2.5rem] blur-xl opacity-30 group-hover:opacity-60 transition-opacity"></div>
                        </div>
                        
                        <div data-aos="fade-right">
                            <h3 class="text-3xl font-black text-white tracking-tight mb-1">{{ $user->name }}</h3>
                            <p class="text-indigo-200 text-lg font-medium opacity-80 mb-3">{{ $user->email }}</p>
                            <div class="flex flex-wrap gap-2 justify-center sm:justify-start">
                                <span class="px-4 py-1.5 bg-teal-500/20 border border-teal-400/30 text-teal-300 rounded-xl text-xs font-bold uppercase tracking-wider backdrop-blur-sm shadow-inner group-hover:bg-teal-500/30 transition-colors">
                                    {{ $profile->student_id ?? 'No Student ID' }}
                                </span>
                                <span class="px-4 py-1.5 bg-white/10 border border-white/20 text-white rounded-xl text-xs font-bold uppercase tracking-wider backdrop-blur-sm">
                                    {{ $profile->department->name ?? 'Department Not Set' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div data-aos="fade-left" class="flex gap-4">
                        <div class="text-center px-6 py-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10">
                            <div class="text-3xl font-black text-white">{{ $totalUploads }}</div>
                            <div class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest">Uploads</div>
                        </div>
                        <div class="text-center px-6 py-4 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10">
                            <div class="text-3xl font-black text-white">{{ $totalDownloads }}</div>
                            <div class="text-[10px] font-bold text-indigo-300 uppercase tracking-widest">Downloads</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Profile Forms with Tabs -->
            <div class="bg-white/80 dark:bg-slate-900/80 backdrop-blur-3xl rounded-[2.5rem] shadow-xl border border-slate-200/50 dark:border-slate-800/50 overflow-hidden min-h-[600px]">
                
                <!-- Tab Navigation -->
                <div class="flex flex-wrap border-b border-slate-200 dark:border-slate-800 bg-slate-50/50 dark:bg-slate-900/50">
                    <button @click="activeTab = 'personal'" :class="activeTab === 'personal' ? 'text-indigo-600 dark:text-indigo-400 border-indigo-600 dark:border-indigo-400 bg-white dark:bg-slate-800' : 'text-slate-500 hover:text-indigo-500 border-transparent'" class="px-8 py-5 text-sm font-bold uppercase tracking-wider border-b-2 transition-all duration-300">
                        Personal Info
                    </button>
                    <button @click="activeTab = 'academic'" :class="activeTab === 'academic' ? 'text-indigo-600 dark:text-indigo-400 border-indigo-600 dark:border-indigo-400 bg-white dark:bg-slate-800' : 'text-slate-500 hover:text-indigo-500 border-transparent'" class="px-8 py-5 text-sm font-bold uppercase tracking-wider border-b-2 transition-all duration-300">
                        Academic Info
                    </button>
                    <button @click="activeTab = 'contact'" :class="activeTab === 'contact' ? 'text-indigo-600 dark:text-indigo-400 border-indigo-600 dark:border-indigo-400 bg-white dark:bg-slate-800' : 'text-slate-500 hover:text-indigo-500 border-transparent'" class="px-8 py-5 text-sm font-bold uppercase tracking-wider border-b-2 transition-all duration-300">
                        Contact & Address
                    </button>
                    <button @click="activeTab = 'financial'" :class="activeTab === 'financial' ? 'text-indigo-600 dark:text-indigo-400 border-indigo-600 dark:border-indigo-400 bg-white dark:bg-slate-800' : 'text-slate-500 hover:text-indigo-500 border-transparent'" class="px-8 py-5 text-sm font-bold uppercase tracking-wider border-b-2 transition-all duration-300">
                        Financial Info
                    </button>
                    <button @click="activeTab = 'tools'" :class="activeTab === 'tools' ? 'text-indigo-600 dark:text-indigo-400 border-indigo-600 dark:border-indigo-400 bg-white dark:bg-slate-800' : 'text-slate-500 hover:text-indigo-500 border-transparent'" class="px-8 py-5 text-sm font-bold uppercase tracking-wider border-b-2 transition-all duration-300">
                        Academic Tools
                    </button>
                </div>

                <!-- Tab Content -->
                <div class="p-8 sm:p-12">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <!-- 1. Personal Info Tab -->
                        <div x-show="activeTab === 'personal'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Photo Upload -->
                                <div class="md:col-span-2">
                                    <x-input-label for="avatar" :value="__('Official Profile Picture')" class="text-indigo-600 dark:text-indigo-400 font-bold mb-3" />
                                    <div class="flex items-center gap-6 p-6 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700">
                                        <div class="w-20 h-20 rounded-xl overflow-hidden bg-white dark:bg-slate-800 border-2 border-indigo-100 dark:border-indigo-900/50">
                                            @php
                                                $avatarPath = $profile->avatar;
                                                $fileExists = $avatarPath && file_exists(storage_path('app/public/' . $avatarPath));
                                            @endphp
                                            @if($avatarPath && $fileExists)
                                                <img src="{{ asset('storage/' . $avatarPath) }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        <input type="file" name="avatar" id="avatar" class="text-sm font-medium text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-black file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
                                    </div>
                                </div>
                                <div>
                                    <x-input-label for="name" :value="__('Full Name')" />
                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-xl" :value="old('name', $user->name)" required autofocus />
                                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                </div>
                                <div>
                                    <x-input-label for="student_id" :value="__('Student ID')" />
                                    <x-text-input id="student_id" name="student_id" type="text" class="mt-1 block w-full rounded-xl" :value="old('student_id', $profile->student_id)" placeholder="e.g. 211-15-XXX" />
                                </div>
                                <div>
                                    <x-input-label for="dob" :value="__('Date of Birth')" />
                                    <x-text-input id="dob" name="dob" type="date" class="mt-1 block w-full rounded-xl" :value="old('dob', $profile->dob)" />
                                </div>
                                <div>
                                    <x-input-label for="blood_group" :value="__('Blood Group')" />
                                    <select id="blood_group" name="blood_group" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                        <option value="">Select Blood Group</option>
                                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $group)
                                            <option value="{{ $group }}" {{ old('blood_group', $profile->blood_group) == $group ? 'selected' : '' }}>{{ $group }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="national_id" :value="__('National ID / Passport No')" />
                                    <x-text-input id="national_id" name="national_id" type="text" class="mt-1 block w-full rounded-xl" :value="old('national_id', $profile->national_id)" />
                                </div>
                            </div>
                        </div>

                        <!-- 2. Academic Info Tab -->
                        <div x-show="activeTab === 'academic'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="md:col-span-2">
                                    <x-input-label for="department_id" :value="__('Department')" />
                                    <select id="department_id" name="department_id" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                        <option value="">Select Department</option>
                                        @php $currentFaculty = ''; @endphp
                                        @foreach($departments as $dept)
                                            @if($currentFaculty !== $dept->faculty)
                                                @if($currentFaculty !== '') </optgroup> @endif
                                                @php $currentFaculty = $dept->faculty; @endphp
                                                <optgroup label="{{ $currentFaculty }}">
                                            @endif
                                            <option value="{{ $dept->id }}" {{ old('department_id', $profile->department_id) == $dept->id ? 'selected' : '' }}>{{ $dept->name }} ({{ $dept->code }})</option>
                                        @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                <div>
                                    <x-input-label for="program" :value="__('Program')" />
                                    <x-text-input id="program" name="program" type="text" class="mt-1 block w-full rounded-xl" :value="old('program', $profile->program)" placeholder="e.g. B.Sc in CSE" />
                                </div>
                                <div>
                                    <x-input-label for="current_semester" :value="__('Current Semester/Batch')" />
                                    <x-text-input id="current_semester" name="current_semester" type="text" class="mt-1 block w-full rounded-xl" :value="old('current_semester', $profile->current_semester)" placeholder="e.g. L4T2" />
                                </div>
                                <div>
                                    <x-input-label for="academic_advisor" :value="__('Academic Advisor')" />
                                    <x-text-input id="academic_advisor" name="academic_advisor" type="text" class="mt-1 block w-full rounded-xl" :value="old('academic_advisor', $profile->academic_advisor)" />
                                </div>
                                <div>
                                    <x-input-label for="cgpa" :value="__('CGPA / GPA')" />
                                    <x-text-input id="cgpa" name="cgpa" type="number" step="0.01" min="0" max="4" class="mt-1 block w-full rounded-xl" :value="old('cgpa', $profile->cgpa)" />
                                </div>
                            </div>
                        </div>

                        <!-- 3. Contact Details Tab -->
                        <div x-show="activeTab === 'contact'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <x-input-label for="email" :value="__('University Email')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-xl opacity-60 bg-slate-100 cursor-not-allowed" :value="old('email', $user->email)" readonly />
                                </div>
                                <div>
                                    <x-input-label for="personal_email" :value="__('Personal Email (Backup)')" />
                                    <x-text-input id="personal_email" name="personal_email" type="email" class="mt-1 block w-full rounded-xl" :value="old('personal_email', $profile->personal_email)" />
                                </div>
                                <div>
                                    <x-input-label for="phone" :value="__('Phone Number')" />
                                    <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full rounded-xl" :value="old('phone', $profile->phone)" />
                                </div>
                                <div>
                                    <x-input-label :value="__('Present Address')" />
                                    <textarea name="present_address" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" rows="3">{{ old('present_address', $profile->present_address) }}</textarea>
                                </div>
                                <div>
                                    <x-input-label :value="__('Permanent Address')" />
                                    <textarea name="permanent_address" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" rows="3">{{ old('permanent_address', $profile->permanent_address) }}</textarea>
                                </div>
                                <div class="p-6 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-200 dark:border-slate-700 space-y-4">
                                    <h4 class="font-bold text-slate-800 dark:text-white">Emergency Contact</h4>
                                    <div>
                                        <x-input-label for="emergency_contact_name" :value="__('Guardian Name')" />
                                        <x-text-input id="emergency_contact_name" name="emergency_contact_name" type="text" class="mt-1 block w-full rounded-xl" :value="old('emergency_contact_name', $profile->emergency_contact_name)" />
                                    </div>
                                    <div>
                                        <x-input-label for="emergency_contact_phone" :value="__('Guardian Phone')" />
                                        <x-text-input id="emergency_contact_phone" name="emergency_contact_phone" type="text" class="mt-1 block w-full rounded-xl" :value="old('emergency_contact_phone', $profile->emergency_contact_phone)" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Financial Information Tab -->
                        <div x-show="activeTab === 'financial'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <x-input-label for="payment_ledger" :value="__('Payment Status / Ledger')" />
                                    <x-text-input id="payment_ledger" name="payment_ledger" type="text" class="mt-1 block w-full rounded-xl" :value="old('payment_ledger', $profile->payment_ledger)" placeholder="e.g. Cleared / Due: 5000" />
                                </div>
                                <div>
                                    <x-input-label :value="__('Scholarship/Waiver Details')" />
                                    <textarea name="scholarship_details" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" rows="3">{{ old('scholarship_details', $profile->scholarship_details) }}</textarea>
                                </div>
                                <div class="md:col-span-2">
                                    <x-input-label :value="__('Transaction History')" />
                                    <textarea name="transaction_history" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" rows="3">{{ old('transaction_history', $profile->transaction_history) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Academic Tools Tab -->
                        <div x-show="activeTab === 'tools'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <x-input-label for="class_routine_link" :value="__('Class Routine Link')" />
                                    <x-text-input id="class_routine_link" name="class_routine_link" type="text" class="mt-1 block w-full rounded-xl" :value="old('class_routine_link', $profile->class_routine_link)" placeholder="https://..." />
                                </div>
                                <div>
                                    <x-input-label for="lms_link" :value="__('BLC / Moodle Access Link')" />
                                    <x-text-input id="lms_link" name="lms_link" type="text" class="mt-1 block w-full rounded-xl" :value="old('lms_link', $profile->lms_link)" />
                                </div>
                                <div>
                                    <x-input-label for="attendance_percentage" :value="__('Attendance Performance (%)')" />
                                    <x-text-input id="attendance_percentage" name="attendance_percentage" type="number" class="mt-1 block w-full rounded-xl" :value="old('attendance_percentage', $profile->attendance_percentage)" />
                                </div>
                                <div class="md:col-span-2">
                                    <x-input-label :value="__('Course Registration History')" />
                                    <textarea name="course_registration" class="mt-1 block w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" rows="3">{{ old('course_registration', $profile->course_registration) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 flex items-center justify-end gap-6 border-t border-slate-200 dark:border-slate-800 pt-8">
                            @if (session('status') === 'profile-updated')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 3000)"
                                    class="text-sm font-bold text-teal-600 dark:text-teal-400 bg-teal-50 dark:bg-teal-900/30 px-4 py-2 rounded-full"
                                >{{ __('Saved successfully.') }}</p>
                            @endif

                            <button type="submit" class="px-10 py-4 bg-gradient-to-r from-indigo-600 to-violet-600 text-white rounded-2xl font-black shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:-translate-y-1 transition-all duration-300 uppercase tracking-widest text-sm">
                                {{ __('Update Profile Info') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Update Password -->
                <div data-aos="fade-up" class="p-8 sm:p-12 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl rounded-[2.5rem] shadow-xl border border-slate-200/50 dark:border-slate-800/50">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- Delete Account -->
                <div data-aos="fade-up" class="p-8 sm:p-12 bg-red-50/50 dark:bg-red-900/10 backdrop-blur-xl rounded-[2.5rem] shadow-xl border border-red-100/50 dark:border-red-900/30">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
