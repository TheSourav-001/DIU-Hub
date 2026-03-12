<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Reset Password</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">No worries! It happens to the best of us.</p>
    </div>

    <div class="mb-6 text-sm text-slate-600 dark:text-slate-400 font-medium leading-relaxed bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-2xl border border-indigo-100 dark:border-indigo-800/50">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="email" class="block w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border-2 border-slate-100 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium" type="email" name="email" :value="old('email')" required autofocus placeholder="name@diu.edu.bd" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-extrabold text-lg shadow-xl shadow-indigo-500/30 transition-all active:scale-[0.98]">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>

        <div class="text-center pt-6 border-t border-slate-100 dark:border-slate-700/50">
            <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>
