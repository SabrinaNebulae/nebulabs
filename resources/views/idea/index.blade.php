<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-white leading-tight">
            {{ __('global.Ideas') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-custom flex md:my-6 mt-0 flex-col md:flex-row ">
    <div class="w-70 md:mr-5 mx-auto md:mx-0">
        <div class="w-70 md:mr-5 mx-auto md:mx-0">
            <div class="bg-white dark:bg-slate-700 dark:text-white md:sticky md:top-8 border-2 dark:border border-gray-200 dark:border-gray-500 rounded-xl mt-16">
                <div class="text-center px-6 py-2 pt-6">
                    <h3 class="font-semibold text-base">{{ __('global.Add an idea') }}</h3>
                    <p class="text-sm mt-4">
                        @auth
                            {{ __('global.Let us know what you would like and we\'ll take a look!') }}
                        @else
                            {{ __('global.Please login to create an idea.') }}
                        @endauth
                    </p>
                </div>
                <livewire:create-idea />
            </div>
        </div>
    </div>
    <div class="w-full px-2 md:px-0 md:w-180">
        <livewire:status-filters />
        <div class="main-content mt-4">
            <livewire:ideas-index />
        </div>
    </div>
</x-app-layout>
