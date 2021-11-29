<div class="idea-and-butttons-container">
    <div class="idea-container bg-white rounded-xl flex mt-4">

        <div class="flex flex-col md:flex-row flex-1 px-4 py-6 ">
                <div class="flex-none mx-2 md:mx-4">
                    <a href="#" >
                        <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                
                <div class="mx-2 md:mx-4 w-full">
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="hover:underline"> {{ $idea->title }} </a>
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        {{ $idea->description }}
                    </div>

                    <div class="flex flex-col md:flex-row md:items-center justify-between mt-6">
                        <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                            <div class="font-bold text-gray-900 md:block hidden "> {{ $idea->user->name }} </div>
                            <div class="md:block hidden">&bull;</div>
                            <div> {{ $idea->created_at->diffForHumans() }} </div>
                            <div>&bull;</div>
                            <div>{{ $idea->category->name }}</div>
                            <div>&bull;</div>
                            <div class="text-gray-800">3 comments</div>
                        </div>

                        <div 
                            x-data="{ show: false }"
                            class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                                {{ $idea->status->name }}
                            </div>
                            <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                    transition duration-150 ease-in"
                                    @click="show = !show"
                                    >
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 
                                    2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                    0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                    10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>

                                <ul class="absolute w-44 text-left font-semibold text-sm bg-white shadow-dialog rounded-t-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                    x-cloak
                                    x-show.transition.origin.top.left.duration.500ms="show"
                                    @click.away="show = false"
                                >
                                    <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Mark as spam</a> </li>
                                    <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Delete Post</a> </li>
                                </ul>

                            </button>
                        </div>

                        <div class="flex items-center md:hidden mt-4 md:mt-0">
                            <div class="bg-gray-100 items-ceter rounded-xl h-10 px-4 py-2 pr-8">
                                <div class="text-sm font-bold leading none @if($hasVoted) text-blue @endif"> {{ $votesCount }} </div>
                                <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                            </div>
                            @if ($hasVoted)
                                <button
                                    wire:click.prevent="vote"  
                                    class="w-20 -mx-5 bg-blue border border-blue text-white font-bold text-xxs uppercase rounded-xl
                                    hover:border-blue hover:bg-blue-hover transition duration-150 ease-in px-4 py-3">
                                    Voted
                                </button>
                            @else
                                <button
                                    wire:click.prevent="vote"  
                                    class="w-20 -mx-5 bg-gray-300 border border-gray-200 font-bold text-xxs uppercase rounded-xl
                                    hover:border-gray-400 transition duration-150 ease-in px-4 py-3">
                                    Vote
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
        </div>

    </div>

    <div class="buttons-container flex items-center justify-between mt-6">

        <div class="flex flex-col md:flex-row items-center space-x-4 md:ml-6">

            <div class=" relative"
                 x-data="{ show:false }"
            >
                <button type="button" 
                    class="items-center justify-center w-32 h-11 flex text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                       transition duration-150 ease-in"
                    @click="show = !show"
                    >
                    <span class="ml-1">Reply</span>
                </button>

                <div class="absolute z-30 bg-white w-70 md:w-104 text-left font-semibold text-sm  shadow-dialog rounded-xl mt-2"
                    x-cloak
                    x-show.transition.origin.top.left.duration.500ms="show"
                >
                    <form action="#" class="space-y-4 px-4 py-6">
                        <div>
                            <textarea name="post_comment" id="post_comment" cols="30" rows="4" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none py-2" placeholder="GO ahead, don't be shy. Share your thougts..."></textarea>
                        </div>

                        <div class="flex flex-col md:flex-row items-center md:space-x-3">
                            <button type="button" 
                                class="items-center justify-center w-full md:w-1/2 h-11  flex text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                                   transition duration-150 ease-in
                                ">
                                <span>Post Comment</span>
                            </button>

                            <button type="button" 
                                    class="items-center justify-center w-full md:w-32 h-11 flex text-sm bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 mt-2 md:mt-0
                                        transition duration-150 ease-in
                            ">

                                <svg class="w-4 text-gray-500 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>

                                <span class="ml-1">Attach</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="relative" x-data="{ show: false }">
                <button type="button" 
                    class="items-center justify-center w-36 h-11 flex mt-2 md:mt-0text-sm bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400
                        transition duration-150 ease-in"
                        @click="show = !show"
                        >

                    <span>Set Status</span>

                    <svg class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    
                </button>

                <div class="absolute z-40 bg-white w-62 md:w-76 text-left font-semibold text-sm  shadow-dialog rounded-xl mt-2"
                     x-cloack
                     x-show="show"
                >
                    <form action="#" class="space-y-4 px-4 py-6">
                        <div class="space-y-2"
                        >
                            <div>
                                <label for="" class="inline-flex items-center">
                                    <input type="radio" class="bg-gray-200 text-black border-none" name="radio-direct" value="1">
                                    <span class="ml-2">Option 1</span>
                                </label>
                            </div>
    
                            <div>
                                <label for="" class="inline-flex items-center">
                                    <input type="radio" class="bg-gray-200 text-purple border-none" name="radio-direct" value="2">
                                    <span class="ml-2">Option 2</span>
                                </label>
                            </div>
    
                            <div>
                                <label for="" class="inline-flex items-center">
                                    <input type="radio" class="bg-gray-200 text-yellow border-none" name="radio-direct" value="3">
                                    <span class="ml-2">Option 3</span>
                                </label>
                            </div>
    
                            <div>
                                <label for="" class="inline-flex items-center">
                                    <input type="radio" class="bg-gray-200 text-green border-none" name="radio-direct" value="3">
                                    <span class="ml-2">Option 4</span>
                                </label>
                            </div>

                            <div>
                                <label for="" class="inline-flex items-center">
                                    <input type="radio" class="bg-gray-200 text-red border-none " name="radio-direct" value="3">
                                    <span class="ml-2">Option 5</span>
                                </label>
                            </div>

                        </div>

                        <div>
                            <textarea name="post_comment" id="post_comment" cols="30" rows="4" 
                            class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none py-2" 
                            placeholder="Add an update comment (optional)"></textarea>
                        </div>

                        <div class="flex items-center justify-between space-x-3">
                            <button type="button" 
                                    class="items-center justify-center  w-1/2 h-11 flex text-sm bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400
                                        transition duration-150 ease-in
                            ">

                                <svg class="w-4 text-gray-500 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>

                                <span class="ml-1">Attach</span>
                            </button>

                            <button type="submit" 
                                    class="items-center justify-center m-1/2  h-11 flex text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                                        transition duration-150 ease-in
                            ">
                                <span class="ml-1">Update</span>
                            </button>

                        </div>

                        <div>
                            <label for="" class="font-normal inline-flex items-center">
                                <input type="checkbox" name="notify_voters" class="rounded bg-gray-200">
                                <span class="ml-2">Notify all voters</span>
                            </label>
                        </div>

                    </form>
                </div>

            </div>

        </div>

        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white sfont-semibold text-center rounded-xl px-3 py-2">
                <div class="text-xl leading-snug @if($hasVoted) text-blue @endif"> {{ $votesCount }} </div>
                <div class="text-gray-400 text-xs font-semibold leading-none">Votes</div>
            </div>

            @if ($hasVoted)
                <button
                    wire:click.prevent="vote"  
                    class="w-32 h-11 -mx-5 bg-blue border border-blue text-white font-bold text-xs uppercase rounded-xl
                    hover:border-blue hover:bg-blue-hover transition duration-150 ease-in px-4 py-3">
                    Voted
                </button>
            @else
                <button
                    wire:click.prevent="vote"  
                    class="w-32 h-11 -mx-5 bg-gray-300 border border-gray-200 font-bold text-xs uppercase rounded-xl
                    hover:border-gray-400 transition duration-150 ease-in px-4 py-3">
                    Vote
                </button>
            @endif
        </div>
        
    </div>
</div>