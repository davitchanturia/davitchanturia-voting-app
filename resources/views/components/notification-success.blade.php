@props([
    'ifFullRefresh' => false,
    'messageToDisplay' => '',
])

<div 
    x-cloak
    x-data="{ 
        show: false, 
        messageToDisplay: '{{ $messageToDisplay }}' ,
        showNotification(message) {
            this.show = true
            this.messageToDisplay = message
            setTimeout(() => {
                this.show = false
            }, 5000)
        }
    }"
    x-show="show"

    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-x-8"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-8"

    @keydown.escape.window="show = false"
    
    x-init="

        @if($ifFullRefresh)
            setTimeout( () => {
                showNotification(messageToDisplay)
            }, 300)
        @else
            livewire.on('ideaWasUpdated', message => {
                showNotification(message)
            })
            
            livewire.on('ideaWasMarkedAsSpam', message => {
                showNotification(message)
            })
            
            livewire.on('ideaWasMarkedAsNotSpam', message => {
                showNotification(message)
            })
            livewire.on('statusWasUpdated', message => {
                showNotification(message)
            })
            livewire.on('commentWasAdded', message => {
                showNotification(message)
            })
            livewire.on('commentWasUpdated', message => {
                showNotification(message)
            })
            livewire.on('commentWasDeleted', message => {
                showNotification(message)
            })
            livewire.on('commentWasMarkedAsSpam', message => {
                showNotification(message)
            })

            livewire.on('commentWasMarkedAsNotSpam', message => {
                showNotification(message)
            })
        @endif
    " 
    
    class="z-20 flex justify-between max-w-xs sm:max-w-sm w-full fixed bottom-0 right-0 
    bg-white rounded-xl shadow-lg border px-4 py-5 mx-0 sm:mx-6 my-8 overflow-hidden">
    <div class="flex items-center">
        <svg class="h-6 w-6 text-green" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <p class="ml-2 font-semibold text-gray-500 text-sm sm:text-base" x-text="messageToDisplay"></p> 
    </div>
    <button 
        @click="show = false"
        class="text-gray-400 hover:text-gray-500">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>
