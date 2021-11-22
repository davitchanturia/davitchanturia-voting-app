<x-app-layout>
  
    <div>
        <a href="/" class="flex items-center font-semibold hover:underline">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            <span class="ml-2">All ideas</span>
        </a>
    </div>

    <div class="idea-container bg-white rounded-xl flex mt-4">

         <div class="flex flex-1 px-4 py-6 ">
                <div class="flex-none">
                    <a href="#" >
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                
                <div class="mx-4 w-full">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline"> A random title can go here</a>
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis harum ipsum nulla non, repudiandae aspernatur doloribus aliquid maiores nisi quidem beatae amet! Suscipit vero soluta in explicabo asperiores voluptates odit, assumenda, dolores rem sequi animi libero natus iusto labore ipsum commodi laboriosam ad molestias eaque? Voluptas id laudantium iste fugiat natus ipsa fugit, est pariatur laborum? Nihil nulla porro soluta libero provident odit quia saepe tenetur a quasi corporis rem quae dolores, amet similique quas exercitationem ea? Maxime, necessitatibus, dolore nesciunt tempore unde asperiores ducimus quasi, ullam soluta repellat ratione. Architecto ad natus nam quas mollitia tenetur eveniet.
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>&bull;</div>
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-800">3 comments</div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                                open
                            </div>
                            <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                    transition duration-150 ease-in">
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 
                                    2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                    0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                    10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>

                                <ul class="absolute w-44 text-left font-semibold text-sm bg-white shadow-dialog rounded-t-xl py-3 ml-8">
                                    <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Mark as spam</a> </li>
                                    <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Delete Post</a> </li>
                                </ul>

                            </button>
                        </div>
                    </div>
                </div>
        </div>

    </div>

    <div class="buttons-container flex items-center justify-between mt-6">

        <div class="flex items-center space-x-4 ml-6">
            <button type="button" 
                class="items-center justify-center w-32 h-11 flex text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                transition duration-150 ease-in
                ">
                <span class="ml-1">Reply</span>
            </button>

            <button type="button" 
                class="items-center justify-center w-36 h-11 flex text-sm bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400
                    transition duration-150 ease-in
                ">

                <span>Set Status</span>

                <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                
            </button>
        </div>

        <div class="flex items-center space-x-3">
            <div class="bg-white sfont-semibold text-center rounded-xl px-3 py-2">
                <div class="text-xl leading-snug">12</div>
                <div class="text-gray-400 text-xs font-semibold leading-none">Votes</div>
            </div>

            <button type="button" 
                class="w-36 h-11  text-sm bg-gray-200 px-6 py-3 font-semibold uppercase rounded-xl border border-gray-200 hover:border-gray-400
                    transition duration-150 ease-in
                ">

                <span>Vote</span>

            </button>
        </div>
        
    </div>

    <div class="comments-container space-y-6 ml-22 my-8 mt-1 pt-4 relative">
        <div class="comment-container relative flex flex-1 px-4 py-6 ">
            <div class="flex-none">
                <a href="#" >
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>
            
            <div class="mx-4 w-full">

                <div class="text-gray-600 mt-3 line-clamp-3">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis harum ipsum nulla non, repudiandae aspernatur doloribus aliquid maiores nisi quidem beatae amet! Suscipit vero soluta in explicabo asperiores voluptates odit, assumenda, dolores rem sequi animi libero natus iusto labore ipsum commodi laboriosam ad molestias eaque? Voluptas id laudantium iste fugiat natus ipsa fugit, est pariatur laborum? Nihil nulla porro soluta libero provident odit quia saepe tenetur a quasi corporis rem quae dolores, amet similique quas exercitationem ea? Maxime, necessitatibus, dolore nesciunt tempore unde asperiores ducimus quasi, ullam soluta repellat ratione. Architecto ad natus nam quas mollitia tenetur eveniet.
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="font-bold text-gray-900">John Doe</div>
                        <div>10 hours ago</div>
                    </div>

                    <div class="flex items-center space-x-2">
                        
                        <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                transition duration-150 ease-in">
                            <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 
                                2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                            </svg>

                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="is-admin comment-container relative flex flex-1 px-4 py-6 ">
            <div class="flex-none">
                <a href="#" >
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=2" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                <div class="mt-1">
                    <h3 class="text-blue text-center uppercase font-bold text-xxs">
                        admin
                    </h3>
                </div>
            </div>
            
            <div class="mx-4 w-full">

                <h4 class="text-xl font-semibold">
                    <a href="#" class="hover:underline"> Status Changed to 'Under Construction' </a>
                </h4>

                <div class="text-gray-600 mt-3 line-clamp-3">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis harum ipsum nulla non, repudiandae aspernatur doloribus aliquid maiores nisi quidem beatae amet! Suscipit vero soluta in explicabo asperiores voluptates odit, assumenda, dolores rem sequi animi libero natus iusto labore ipsum commodi laboriosam ad molestias eaque? Voluptas id laudantium iste fugiat natus ipsa fugit, est pariatur laborum? Nihil nulla porro soluta libero provident odit quia saepe tenetur a quasi corporis rem quae dolores, amet similique quas exercitationem ea? Maxime, necessitatibus, dolore nesciunt tempore unde asperiores ducimus quasi, ullam soluta repellat ratione. Architecto ad natus nam quas mollitia tenetur eveniet.
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="font-bold text-blue">John Doe</div>
                        <div>10 hours ago</div>
                    </div>

                    <div class="flex items-center space-x-2">
                        
                        <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                transition duration-150 ease-in">
                            <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 
                                2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                            </svg>

                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="comment-container relative flex flex-1 px-4 py-6 ">
            <div class="flex-none">
                <a href="#" >
                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=5" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
                
            </div>
            
            <div class="mx-4 w-full">

                <div class="text-gray-600 mt-3 line-clamp-3">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis harum ipsum nulla non, repudiandae aspernatur doloribus aliquid maiores nisi quidem beatae amet! Suscipit vero soluta in explicabo asperiores voluptates odit, assumenda, dolores rem sequi animi libero natus iusto labore ipsum commodi laboriosam ad molestias eaque? Voluptas id laudantium iste fugiat natus ipsa fugit, est pariatur laborum? Nihil nulla porro soluta libero provident odit quia saepe tenetur a quasi corporis rem quae dolores, amet similique quas exercitationem ea? Maxime, necessitatibus, dolore nesciunt tempore unde asperiores ducimus quasi, ullam soluta repellat ratione. Architecto ad natus nam quas mollitia tenetur eveniet.
                </div>

                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                        <div class="font-bold text-gray-900">John Doe</div>
                        <div>10 hours ago</div>
                    </div>

                    <div class="flex items-center space-x-2">
                        
                        <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                transition duration-150 ease-in">
                            <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 
                                2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                            </svg>

                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
