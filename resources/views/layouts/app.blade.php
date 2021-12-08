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
                <div class="px-6 py-4 ">
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </a>
                    </form>  
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                    @endauth
                </div>
        @endif


               <a href="#">
                   <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" 
                             alt="avatar" class="w-10 h-10 rounded-full">
               </a>
           </div>
       </header>

       <main class="container mx-auto max-w-custom flex flex-col md:flex-row md:stiky md:top-8" >
            <div class="w-70 mx-auto md:mr-5 md:mx-0" >
                <div class="border-2  rounded-xl mt-16 bg-white"
                     style=" border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
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


                    @auth
                    <livewire:create-idea />
                    @else
                    <div class="my-6 text-center">
                        <a  
                            href="{{ route('login') }}"
                             class="justify-center inline-block w-1/2 h-11 text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                                transition duration-150 ease-in
                            ">
                               Login
                         </a>

                         <a 
                            href="{{ route('register') }}"
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
            <x-notification-success 
                :ifFullRefresh="true"
                messageToDisplay="{{ session('success_message') }}"
            />
        @endif

       <livewire:scripts />
    </body>
</html>
