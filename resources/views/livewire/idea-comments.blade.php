<div>
    @if ($comments->isNotEmpty())
        <div class="comments-container z-0 space-y-6 md:ml-22 my-8 mt-1 pt-4 relative">
        
            @foreach ($comments as $comment)
                <livewire:idea-comment 
                    :key="$comment->id"
                    :comment="$comment"
                />
            @endforeach
            {{-- <div class="is-admin comment-container relative flex flex-1 px-4 py-6 ">
                <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
                    <div class="flex-none">
                    <a href="#" >
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=3" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                    </div>
                    
                    <div class="md:mx-4 w-full">
    
                    <div class="text-gray-600 mt-3 line-clamp-3">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione accusamus omnis harum ipsum nulla non, repudiandae aspernatur doloribus aliquid maiores nisi quidem beatae amet! Suscipit vero soluta in explicabo asperiores voluptates odit, assumenda, dolores rem sequi animi libero natus iusto labore ipsum commodi laboriosam ad molestias eaque? Voluptas id laudantium iste fugiat natus ipsa fugit, est pariatur laborum? Nihil nulla porro soluta libero provident odit quia saepe tenetur a quasi corporis rem quae dolores, amet similique quas exercitationem ea? Maxime, necessitatibus, dolore nesciunt tempore unde asperiores ducimus quasi, ullam soluta repellat ratione. Architecto ad natus nam quas mollitia tenetur eveniet.
                    </div>
    
                    <div class="flex items-center justify-between mt-6">
                        <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                            <div class="font-bold text-gray-900">John Doe</div>
                            <div>10 hours ago</div>
                        </div>
    
                        <div class="flex items-center space-x-2"
                             x-data="{ show: false }"
                        >
                            
                            <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                    transition duration-150 ease-in"
                                    @click="show = !show"
                                    >
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 
                                    2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                    0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                    10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>
    
                                <ul class="absolute  z-50 w-44 text-left font-semibold text-sm bg-white shadow-dialog rounded-t-xl py-3 right-0 top-8 md:left-0 md:top-6 md:ml-8 "
                                    x-cloak
                                    x-show.transition.origin.top.left="show"
                                    @click.away="show = false"
                                >
                                    <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Mark as spam</a> </li>
                                    <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Delete Post</a> </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
    
            </div> --}}
        
        </div>
    @else 
        <div class="mx-auto w-70 mt-12">
            <img src="{{ asset('img/no-ideas.svg') }}" alt="No Ideas" class="mx-auto mix-blend-luminosity">
            <div class="text-gray-400 text-center font-bold mt-6">No comments yet...</div>
        </div>
    @endif
    
</div>
