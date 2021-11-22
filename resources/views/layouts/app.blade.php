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

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans bg-bodyColor text-gray-900 text-sm">

        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
           <a href="#">
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
                        <p class="text-xs mt-4">Let us know what you would like and we will take a look over!</p>
                    </div>

                    <form action="#" method="post" class="space-y-4 px-4 py-6 ">
                        @csrf

                        <div>
                            <input type="text" class="w-full text-sm border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Your idea">
                        </div>

                        <div>
                            <select name="category_add" id="category_add" 
                                class="w-full bg-gray-100 rounded-xl px-4 py-2 border-none text-sm">

                                <option value="category one">category one</option>
                                <option value="category two">category two</option>
                                <option value="category three">category three</option>
                                <option value="category four">category four</option>
                            </select>
                        </div>

                        <div>
                            <textarea name="idea" id="idea" cols="30" rows="4"  
                                class="w-full bg-gray-100 rounded-xl placeholder-gray-900 text-sm px-4 py-2 border-none"
                                placeholder="Describe your idea"></textarea>
                        </div>
                        <div class="flex items-center justify-between space-x-3">
                            <button type="button" 
                                    class="items-center justify-center w-1/2 h-11 flex text-sm bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400
                                        transition duration-150 ease-in
                            ">

                                <svg class="w-4 text-gray-500 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>

                                <span class="ml-1">Attach</span>
                            </button>

                            <button type="submit" 
                                    class="items-center justify-center w-1/2 h-11 flex text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                                        transition duration-150 ease-in
                            ">
                                <span class="ml-1">Submit</span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>

            <div class="w-full px-2 md:px-0 md:w-175">
                <nav class="hidden md:flex items-center justify-between text-xs">
                    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3">
                        <li>
                            <a href="#" class="border-b-4 pb-3 border-blue">
                                All Ideas (87)
                            </a>
                        </li>
                        <li>
                            <a href="" class="text-gray-400 border-b-4 pb-3 
                                                transition duration-150 ease-in hover:border-blue" >
                                Considering (10)
                            </a>
                        </li>
                        <li>
                            <a href="" class="text-gray-400 border-b-4 pb-3 
                                                transition duration-150 ease-in hover:border-blue" >
                                In Progress (11)
                            </a>
                        </li>
                    </ul>

                    <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10">
                        <li>
                            <a href="" class="text-gray-400 border-b-4 pb-3 
                                                transition duration-150 ease-in hover:border-blue" >
                                Implemented (10)
                            </a>
                        </li>
                        <li>
                            <a href="" class="text-gray-400 border-b-4 pb-3 
                                                transition duration-150 ease-in hover:border-blue" >
                                CLosed (55)
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>

            <div class="w-24"></div>

       </main>

    </body>
</html>
