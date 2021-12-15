<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laracast Voting</title>

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
                <div class="px-6 py-4">
                    <div class="flex items-center space-x-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>

                            <div x-data="{ show: false}" class="relative">
                                <button @click="show = !show">
                                    <svg class="h-8 w-8 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                                    </svg>
                                    <div  
                                        class="absolute -top-1 -right-1 rounded-full border-2 bg-red text-white text-xxs w-6 h-6 flex 
                                        justify-center items-center">
                                        8
                                    </div>
                                </button>

                                <ul class="absolute -right-28 md:-right-12 w-76 max-h-128 overflow-y-auto md:w-96 text-left text-xs bg-white shadow-dialog 
                                    rounded-t-xl"
                                    x-cloak
                                    x-show="show"
                                    x-transition.origin.top.duration.400ms
                                    @click.away="show = false"
                                    @keydown.escape.window="show = false">

                                    <li>
                                        <a @click.prevent="
                                             show = false
                                            " href="#" class="flex hover:bg-gray-100 px-5 py-3 ">
                                            <img src="https://www.gravatar.com/avatar/c6ad550c8f30082474d1e58d20f67b3a" 
                                                class="rounded-xl w-10 h-10" alt="avatar">
                                            <div class="ml-4">
                                                <div class="line-clamp-6">
                                                    <span class="font-semibold">dasad</span>
                                                    comented on
                                                    <span>this is my idea</span>:
                                                    <span>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, unde, quos fuga cumque sed tempore quisquam debitis id quo amet officia vitae perspiciatis exercitationem. Ad dolorum eligendi, suscipit non alias sit nihil sint sapiente aut, temporibus eos commodi reprehenderit deserunt dicta beatae ex fuga nisi totam nam quo voluptates libero."
                                                    </span>
                                                    
                                                </div>
                                                <div class="text-xs text-gray-500 mt-2">1 hour ago</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a @click.prevent="
                                             show = false
                                            " href="#" class="flex hover:bg-gray-100 px-5 py-3 ">
                                            <img src="https://www.gravatar.com/avatar/c6ad550c8f30082474d1e58d20f67b3a" 
                                                class="rounded-xl w-10 h-10" alt="avatar">
                                            <div class="ml-4">
                                                <div class="line-clamp-6">
                                                    <span class="font-semibold">dasad</span>
                                                    comented on
                                                    <span>this is my idea</span>:
                                                    <span>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, unde, quos fuga cumque sed tempore quisquam debitis id quo amet officia vitae perspiciatis exercitationem. Ad dolorum eligendi, suscipit non alias sit nihil sint sapiente aut, temporibus eos commodi reprehenderit deserunt dicta beatae ex fuga nisi totam nam quo voluptates libero."
                                                    </span>
                                                    
                                                </div>
                                                <div class="text-xs text-gray-500 mt-2">1 hour ago</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li class="border-t border-gray-300 text-center">
                                        <button 
                                           class="w-full block font-semibold hover:bg-gray-100 px-5 py-4">
                                           Mark all as read
                                        </button>
                                    </li>

                                </ul>
                            </div>
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


            <a href="#">
                <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar"
                    class="w-10 h-10 rounded-full">
            </a>
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
                    <div class="   text-center px-6 py-2 pt-6">
                <h3 class="text-base font-semibold">Add an idea</h3>
                <p class="text-xs mt-4">
                    @auth
                        Let us know what you would like and we will take a look over!
                    @else
                        Please login to create a idea
                    @endauth
                </p>
            </div>


            @auth
                <livewire:create-idea />
            @else
                <div class="my-6 text-center">
                    <a href="{{ route('login') }}"
                        class="justify-center inline-block w-1/2 h-11 text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                                transition duration-150 ease-in
                            ">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                        class="justify-center inline-block w-1/2 h-11 text-sm mt-2 bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400
                                transition duration-150 ease-in
                            ">
                        Sign up
                    </a>
                </div>
            @endauth
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

    <livewire:scripts />
</body>

</html>
