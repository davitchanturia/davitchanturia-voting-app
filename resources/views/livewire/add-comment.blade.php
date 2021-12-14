<div class=" relative"
     x-data="{ show:false }"
     x-init="
        Livewire.on('commentWasAdded', () => {
            show = false
        })
        {{-- კომენტარის დამატებისას უნდა ჩამოსქროლოს დამატებულ კომენტარზე და 5 წამით გაამწვანოს --}}
        Livewire.hook('message.processed', (message, component) => {

            if (['commentWasAdded', 'statusWasUpdated'].includes(message.updateQueue[0].payload.event) {{-- ვამოწმებთ ივენთს --}}
             && message.component.fingerprint.name === 'idea-comments'){  {{-- ვამოწმებთ ელემენტს რომელზეც ზემოქმედებს ივენთი --}}

                const lastComment = document.querySelector('.comment-container:last-child')
                lastComment.scrollIntoView({ behavior: 'smooth'})

                lastComment.classList.add('bg-green-50')
                setTimeout(() => {
                    lastComment.classList.remove('bg-green-50')
                }, 5000)
            }

            {{-- თუ შეევცვლით კომენტარების ფეიჯს უნდა ასქროლოს პირველ კომენტართან --}}
            if(['gotoPage', 'previousPage', 'nextPage'].includes(message.updateQueue[0].method)){
                
                const firstComment = document.querySelector('.comment-container:first-child')
                firstComment.scrollIntoView({ behavior: 'smooth'})
            }
        })

    " 
 >
    <button type="button" 
        class="items-center justify-center w-32 h-11 flex text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
           transition duration-150 ease-in"
        @click="
            show = !show
            if (show){
                $nextTick(() => $refs.comment.focus() )  {{-- როცა კომენტარის მოდალი ამოხტება ინფუთი იქნება დაფოკუსებული // comment სელექტორია ღილაკის --}}   
            }
        "
        >
        <span class="ml-1">Reply</span>
    </button>

    <div class="absolute z-30 bg-white w-70 md:w-104 text-left font-semibold text-sm  shadow-dialog rounded-xl mt-2"
        x-cloak
        x-show.transition.origin.top.left.duration.500ms="show"
    >
        @auth
        <form wire:submit.prevent="addComment" action="#" class="space-y-4 px-4 py-6">
            <div>
                <textarea wire:model="comment" x-ref="comment" name="post_comment" id="post_comment" cols="30" 
                rows="4" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 
                border-none py-2" placeholder="GO ahead, don't be shy. Share your thougts..." 
                required></textarea>
                
                @error('comment')
                   <p class="text-red text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col md:flex-row items-center md:space-x-3">
                <button type="submit" 
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
        @else 
        <div class="px-4 py-6">
            <p class="font-normal">Please login or create an account to post a comment.</p>
            <div class="flex items-center space-x-3 mt-8">
                <a
                    href="{{ route('login') }}"
                    class="w-1/2 h-11 text-sm text-center bg-blue text-white font-semibold rounded-xl hover:bg-blue-hover transition duration-150 ease-in px-6 py-3"
                >
                    Login
                </a>
                <a
                    href="{{ route('register') }}"
                    class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-gray-400 transition duration-150 ease-in px-6 py-3"
                >
                    Sign Up
                </a>
            </div>
        </div>
        @endauth
       
    </div>
</div>