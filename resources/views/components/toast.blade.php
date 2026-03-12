@props(['on'])

<div x-data="{ show: false, message: '' }"
     x-on:toast.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform translate-y-2 sm:translate-y-0 sm:translate-x-2"
     x-transition:enter-end="opacity-100 transform translate-y-0 sm:translate-x-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 transform translate-y-0 sm:translate-x-0"
     x-transition:leave-end="opacity-0 transform translate-y-2 sm:translate-y-0 sm:translate-x-2"
     class="fixed bottom-5 right-5 z-[100] max-w-sm w-full bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 rounded-2xl shadow-2xl p-4 flex items-center gap-4 border-l-4 border-l-blue-500"
     style="display: none;">
    <div class="bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 p-2 rounded-xl">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
    </div>
    <div class="flex-1">
        <p class="text-sm font-bold text-slate-800 dark:text-white" x-text="message"></p>
    </div>
    <button @click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>
