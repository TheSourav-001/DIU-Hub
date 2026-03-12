<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Create Account</h2>
        <p class="text-slate-500 dark:text-slate-400 mt-2 font-medium">Join DIU Hub to start sharing materials.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div class="space-y-1.5">
            <x-input-label for="name" :value="__('Full Name')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="name" class="block w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border-2 border-slate-100 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Sourav Dipto" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="space-y-1.5">
            <x-input-label for="email" :value="__('Email Address')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="email" class="block w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border-2 border-slate-100 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="name@diu.edu.bd" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="space-y-1.5">
            <x-input-label for="password" :value="__('Password')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="password" class="block w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border-2 border-slate-100 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-1.5">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-700 dark:text-slate-300 font-bold ml-1" />
            <x-text-input id="password_confirmation" class="block w-full px-5 py-4 bg-slate-50 dark:bg-slate-900/50 border-2 border-slate-100 dark:border-slate-700 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 transition-all font-medium"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-extrabold text-lg shadow-xl shadow-indigo-500/30 transition-all active:scale-[0.98]">
                {{ __('Create Account') }}
            </button>
        </div>

        <div class="text-center pt-5 border-t border-slate-100 dark:border-slate-700/50">
            <p class="text-slate-500 dark:text-slate-400 font-medium">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Log in</a>
            </p>
        </div>
    </form>
</x-guest-layout>
