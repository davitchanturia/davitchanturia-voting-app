<div 
    x-cloak
    x-data="{ show: false }"
    x-show="show"
    @keydown.escape.window="show = false"
    {{-- @custom-show-edit-modal.window="  
        show=true
        $nextTick(()=> $refs.title.focus() )  
    "   --}}
    x-init="
        livewire.on('commentWasUpdated', () => {
            show = false
        })

        livewire.on('editCommentWasSet', () => {
            show = true
            $nextTick(()=> $refs.editComment.focus() )  
        })
    "

    class="fixed z-10 inset-0 overflow-y-auto" $ide$ide
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
>

    <div class="flex items-end justify-center min-h-screen ">
        <div 
            x-show="show"
            transition.opacity
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
            aria-hidden="true">
        </div>
 
        <div x-show ="show"
             x-transition.origin.bottom.duration.300ms
            class="modal bg-white rounded-tl-lg rounded-tr-xl px-4 pt-5 pb-4 overflow-hidden transform transition-all py-4 sm:max-w-lg sm:w-full sm:p-6 "
        >
        
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button 
                    @click="show = false"
                    class="text-gray-400 hover:text-gray-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

             <div class="vg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

                <h3 class="text-center text-lg font-medium text-gray-900">Edit Comment</h3>

                <form wire:submit.prevent="updateComment" action="#" method="post" class="space-y-4 px-4 py-6 ">
                    @csrf

                    <div>
                        <textarea wire:model.defer="body" 
                            x-ref="editComment"
                            name="idea" cols="30" rows="4"  
                            class="w-full bg-gray-100 rounded-xl placeholder-gray-900 text-sm 
                                px-4 py-2 border-none"
                            placeholder="Edit your comment" ></textarea>
                 
                         @error('body')
                             <p class="text-red text-xs mt-1"> {{ $message }} </p>
                         @enderror
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
                             <span class="ml-1">Update</span>
                         </button>
                 
                    </div>
                 
                 
                </form>

            </div>
        </div>
    </div>
  </div>
  
