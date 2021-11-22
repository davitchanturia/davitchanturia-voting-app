<x-app-layout>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6 ">
        <div class="w-full md:w-1/3 ">

            <select name="category" id="category" 
                class="w-full rounded-xl px-4 py-2 border-none">

                <option value="category one">category one</option>
                <option value="category two">category two</option>
                <option value="category three">category three</option>
                <option value="category four">category four</option>
            </select>

        </div>

        <div class="w-full md:w-1/3">

            <select name="other_filters" id="other_filters" 
                class="w-full rounded-xl px-4 py-2 border-none">

                <option value="category one">category one</option>
                <option value="category two">category two</option>
                <option value="category three">category three</option>
                <option value="category four">category four</option>
                
            </select>

        </div>

        <div class="w-full md:w-2/3 relative ">

            <input type="search" placeholder="FInd an idea" 
                class="w-full rounded-xl bg-white px-4 py-2 pl-10 border-none placeholder-gray-900"
            >

            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

        </div>

    </div>


    <div class="ideas-container space-y-6 my-6">
        <div class="idea-container bg-white rounded-xl flex cursor-pointer
            hover:shadow-card transition duration-150 ease-in
            ">

            {{-- first div --}}
            <div class="hidden md:block border-r border-gray-100 px-5 py-8">

                <div class="text-center">
                    <div class="font-semibold text-2xl"> 12 </div>
                    <div class="text-gray-500"> Votes </div>
                </div>

                <div class="mt-8">
                    <button class="w-20 bg-gray-200 font-bold text-xxs uppercase rounded-xl px-4 py-3 border border-gray-200 
                                 hover:border-gray-400 transition duration-150 ease-in">
                        Vote
                    </button>
                </div>

            </div>

            {{-- second div --}}
            <div class="flex flex-col md:flex-row flex-1 px-2 py-6 ">
                <div class="flex-none mx-2 md:mx-4 ">
                    <a href="#" >
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                
                <div class="md:mx-4 mx-2 w-full flex flex-col justify-between">
                    <h4 class="text-xl font-semibold mt-2 md:mt-0">
                        <a href="#" class="hover:underline"> A random title can go here</a>
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis harum ipsum nulla non, repudiandae aspernatur doloribus aliquid maiores nisi quidem beatae amet! Suscipit vero soluta in explicabo asperiores voluptates odit, assumenda, dolores rem sequi animi libero natus iusto labore ipsum commodi laboriosam ad molestias eaque? Voluptas id laudantium iste fugiat natus ipsa fugit, est pariatur laborum? Nihil nulla porro soluta libero provident odit quia saepe tenetur a quasi corporis rem quae dolores, amet similique quas exercitationem ea? Maxime, necessitatibus, dolore nesciunt tempore unde asperiores ducimus quasi, ullam soluta repellat ratione. Architecto ad natus nam quas mollitia tenetur eveniet.
                    </div>

                    <div class="flex flex-col  md:flex-row justify-between md:items-center  mt-6">
                        <div class="flex items-center text-xs font-semibold md:space-x-2 text-gray-400">
                            <div>10 hours ago</div>
                            <div>&bull;</div>
                            <div>Category 1</div>
                            <div>&bull;</div>
                            <div class="text-gray-800">3 comments</div>
                        </div>

                        <div class="flex items-center space-x-2 mt-4 md:mt-0"
                              x-data="{ isOpen: false}">
                            <div class="bg-gray-200 text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                                open
                            </div>


                            <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                    transition duration-150 ease-in"
                                    @click="isOpen = !isOpen"
                                    >
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 
                                    2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                    0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                    10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>

                                <ul class="absolute w-44 text-left font-semibold text-sm bg-white shadow-dialog rounded-t-xl py-3 right-0 top-8 md:left-0 md:top-6 md:ml-8 "
                                    x-cloak
                                    x-show.transition.origin.top.left="isOpen"
                                    @click.away="isOpen = false"
                                >
                                    <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Mark as spam</a> </li>
                                    <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Delete Post</a> </li>
                                </ul>

                            </button>
                        </div>

                        <div class="flex items-center md:hidden mt-4 md:mt-0">
                            <div class="bg-gray-100 items-ceter rounded-xl h-10 px-4 py-2 pr-8">
                                <div class="text-sm font-bold leading none">12</div>
                                <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                            </div>
                            <button class="w-20 -mx-5 bg-gray-300 border border-gray-200 font-bold text-xxs uppercase rounded-xl
                                hover:border-gray-400 transition duration-150 ease-in px-4 py-3">
                                Vote
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>

</x-app-layout>
