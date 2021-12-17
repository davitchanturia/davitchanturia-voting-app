<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>{{ $title ?? 'Laracast Voting' }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <livewire:styles />


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans bg-bodyColor text-gray-900 text-sm">

    <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
        <a href="{{ route('idea.index') }}">
            <img src="{{ asset('img/logo.svg') }}" alt="">
        </a>

        <div class="flex items-center mt-2 md:mt-0">

            @if (Route::has('login'))
                <div class="flex items-center px-6 py-4">
                    <div class="flex items-center space-x-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>

                            <livewire:comment-notifications />
                        </div>

                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            @auth   
                <a href="#" class="ml-2">
                    <img src="{{auth()->user()->getAvatar()}}" alt="avatar"
                    class="w-10 h-10 rounded-full">
                </a>
            @endauth
        </div>
    </header>

    <main class="container mx-auto max-w-custom flex flex-col md:flex-row md:stiky md:top-8">
        <div class="w-70 mx-auto md:mr-5 md:mx-0">
            <div class="border-2  rounded-xl mt-16 bg-white" style=" border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                     border-image-slice: 1;
                     background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                     background-origin: border-box;
                     background-clip: content-box, border-box;
                   ""
                >
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="text-base font-semibold">Add an idea</h3>
                        <p class="text-xs mt-4">
                            @auth
                                Let us know what you would like and we will take a look over!
                            @else
                                Please login to create a idea
                            @endauth
                        </p>
                    </div>

            <livewire:create-idea />
            </div>
        </div>

        <div class="w-full px-2 md:px-0 md:w-175">
            <livewire:status-filters />

            <div class="mt-8">
                {{ $slot }}
            </div>
        </div>

        <div class="w-24"></div>

    </main>

    @if (session('success_message'))
        <x-notification-success :ifFullRefresh="true" messageToDisplay="{{ session('success_message') }}" />
    @endif

    @if (session('error_message'))
        <x-notification-success type="error" :ifFullRefresh="true"
            messageToDisplay="{{ session('error_message') }}" />
    @endif

    <livewire:scripts />
</body>

</html>
