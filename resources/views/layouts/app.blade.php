<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('storage/fav/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('storage/fav/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/fav/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('storage/fav/site.webmanifest')}}">

    <title>{{ $title ??  __('Vote') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body 
    x-data="{ darkMode: false }" 
    x-init="
        if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        localStorage.setItem('darkMode', JSON.stringify(true));
        }
        darkMode = JSON.parse(localStorage.getItem('darkMode'));
        $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    x-cloak
    class="font-sans text-gray-900 text-sm"
>
    <x-jet-banner />
        <div x-bind:class="{'dark' : darkMode === true}">
        <div  class="min-h-screen bg-gray-100 dark:bg-slate-800">
        
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-slate-700 dark:text-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <!-- Add an idea container -->
            <main class="container mx-auto">
                
                        {{ $slot }}

                </div>

            </main>

            @if (session('success_message'))
                <x-notification-success
                    :redirect="true"
                    message-to-display="{{ (session('success_message')) }}"
                />
            @endif
            

            @if (session('error_message'))
                <x-notification-success
                    type="error"
                    :redirect="true"
                    message-to-display="{{ (session('error_message')) }}"
                />
            @endif


        </div>
</div>
    @stack('modals')

    @livewireScripts
</body>

</html>
