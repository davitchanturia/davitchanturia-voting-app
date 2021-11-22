<x-app-layout>
    <div class="filters flex space-x-6 ">
        <div class="w-1/3 ">

            <select name="category" id="category" 
                class="w-full rounded-xl px-4 py-2 border-none">

                <option value="category one">category one</option>
                <option value="category two">category two</option>
                <option value="category three">category three</option>
                <option value="category four">category four</option>
            </select>

        </div>

        <div class="w-1/3">

            <select name="other_filters" id="other_filters" 
                class="w-full rounded-xl px-4 py-2 border-none">

                <option value="category one">category one</option>
                <option value="category two">category two</option>
                <option value="category three">category three</option>
                <option value="category four">category four</option>
                
            </select>

        </div>

        <div class="w-2/3 relative ">

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
            <div class="border-r border-gray-100 px-5 py-8">

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
            <div class="flex flex-1 px-2 py-6 ">
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
    </div>

</x-app-layout>
