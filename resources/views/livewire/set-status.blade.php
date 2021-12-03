<div 
    class="relative" 
    x-data="{ show: false }"
    x-init="
        window.livewire.on('statusWasUpdated', () => {
            show = false
        })
    "
>
    <button type="button" 
        class="items-center justify-center w-36 h-11 flex mt-2 md:mt-0 text-sm bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400
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
        <form wire:submit.prevent="setStatus" action="#" class="space-y-4 px-4 py-6">
            <div class="space-y-2"
            >
                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-black border-none" name="radio-direct" value="1">
                        <span class="ml-2">Option 1</span>
                    </label>
                </div>

                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-purple border-none" name="radio-direct" value="2">
                        <span class="ml-2">Option 2</span>
                    </label>
                </div>

                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-yellow border-none" name="radio-direct" value="3">
                        <span class="ml-2">Option 3</span>
                    </label>
                </div>

                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-green border-none" name="radio-direct" value="4">
                        <span class="ml-2">Option 4</span>
                    </label>
                </div>

                <div>
                    <label for="" class="inline-flex items-center">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-red border-none " name="radio-direct" value="5">
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
