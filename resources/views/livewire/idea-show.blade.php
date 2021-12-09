<div class="idea-and-butttons-container">
    <div class="idea-container bg-white rounded-xl flex mt-4">

        <div class="flex flex-col md:flex-row flex-1 px-4 py-6 ">
                <div class="flex-none mx-2 ">
                    <a href="#" >
                        <img src="{{ $idea->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                
                <div class="mx-2 md:mx-4 w-full">
                    <h4 class="text-xl font-semibold mt-2 md:mt-0">
                        {{ $idea->title }} 
                    </h4>

                    <div class="text-gray-600 mt-3 line-clamp-3">
                        @admin
                            @if ($idea->spam_reports > 0)   
                                <div class="text-red mb-2">
                                    Spam Reports: {{ $idea->spam_reports}}
                                    
                                </div>
                            @endif
                         @endadmin
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
                            <div class="text-gray-800">{{ $idea->comments->count() }} comments</div>
                        </div>

                        <div 
                            x-data="{ show: false }"
                            class="flex items-center space-x-2 mt-4 md:mt-0">
                            <div class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">
                                {{ $idea->status->name }}
                            </div>
                            @auth
                            <div class="relative z-50 sm:z-10">
                                <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                    transition duration-150 ease-in"
                                    @click="show = !show"
                                    >
                                    <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 
                                        2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                        0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                        10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                    </svg>
                                </button>

                                <ul class="absolute w-44 text-left font-semibold text-sm bg-white shadow-dialog rounded-t-xl py-3 md:ml-8 top-8 md:top-6 right-0 md:left-0"
                                    x-cloak
                                    x-show.transition.origin.top.left.duration.500ms="show"
                                    @click.away="show = false"
                                >
                                    @can('update', $idea) 
                                        
                                        <li> 
                                            <a  
                                               @click.prevent="
                                                   show = false
                                                   $dispatch('custom-show-edit-modal') {{-- ვაგზავნით ივენთს --}}
                                               "
                                               href="#" 
                                               class="hover:bg-gray-100 px-5 py-3 block">
                                               Edit Idea
                                            </a> 
                                        </li>
                                    @endcan

                                    @can('delete', $idea) 
                                        <li> 
                                            <a 
                                                @click.prevent="
                                                    show = false
                                                    $dispatch('custom-show-delete-modal') {{-- ვაგზავნით ივენთს --}}
                                                "
                                                href="#" class="hover:bg-gray-100 px-5 py-3 block">
                                                Delete Idea
                                            </a> 
                                        </li>
                                    @endcan
                                  
                                    <li> 
                                        <a 
                                            @click.prevent="
                                            show = false
                                            $dispatch('custom-show-markspam-modal')
                                            "
                                            href="#" class="hover:bg-gray-100 px-5 py-3 block">
                                            Mark as spam
                                        </a> 
                                    </li>

                                    @admin
                                    @if ($idea->spam_reports > 0)
                                        
                                    <li> 
                                        <a 
                                            @click.prevent="
                                            show = false
                                            $dispatch('custom-show-mark-nospam-modal')
                                            "
                                            href="#" class="hover:bg-gray-100 px-5 py-3 block">
                                            Not spam
                                        </a> 
                                    </li>
                                    @endif
                                    @endadmin
                                </ul>
                            </div>
                            @endauth

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

            <livewire:add-comment :idea="$idea"/>

            @admin
                <livewire:set-status :idea="$idea"/>
            @endadmin
          

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