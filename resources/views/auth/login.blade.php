<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Welcome Back</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Log in to access your study resources.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="email" class="block w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border-2 border-slate-100 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@diu.edu.bd" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <div class="flex items-center justify-between ml-1">
                <x-input-label for="password" :value="__('Password')" class="text-slate-700 dark:text-slate-300 font-bold" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border-2 border-slate-100 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium"
                            type="password"
                            name="password"
                            required autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="w-5 h-5 rounded-lg border-2 border-slate-200 dark:border-slate-700 text-indigo-600 focus:ring-indigo-500/20 transition-all cursor-pointer" name="remember">
                <span class="ms-3 text-sm font-bold text-slate-600 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-slate-200 transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-extrabold text-lg shadow-xl shadow-indigo-500/30 transition-all active:scale-[0.98]">
                {{ __('Log in') }}
            </button>
        </div>

        <div class="text-center pt-4 border-t border-slate-100 dark:border-slate-700/50">
            <p class="text-slate-500 dark:text-slate-400 font-medium">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Sign up</a>
            </p>
        </div>
    </form>
</x-guest-layout>
