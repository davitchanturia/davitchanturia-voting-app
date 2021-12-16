<div x-data="{ show: false}" class="relative">
    <button @click="
        show = !show

        if(show){
            Livewire.emit('getNotifications')
        }
    ">
        <svg class="h-8 w-8 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
        </svg>
        @if ($notificationCount > 0)
            <div
                class="absolute -top-1 -right-1 rounded-full border-2 bg-red text-white text-xxs w-6 h-6 flex 
                justify-center items-center">
                {{ $notificationCount }}
            </div>
        @endif
    </button>

    <ul class="absolute -right-28 md:-right-12 w-76 max-h-128 overflow-y-auto md:w-96 text-left text-xs bg-white shadow-dialog 
        rounded-t-xl"
        x-cloak x-show="show" x-transition.origin.top.duration.400ms @click.away="show = false"
        @keydown.escape.window="show = false">

        @if ($notifications->isNotEmpty() && !$isLoading)

            @foreach ($notifications as $notification)

                <li>
                    <a 
                        @click.prevent="
                          show = false
                        "
                        wire:click.prevent="markAsRead('{{ $notification->id }}')"
                        class="flex hover:bg-gray-100 px-5 py-3 ">
                        <img src="{{ $notification->data['user_avatar'] }}" class="rounded-xl w-10 h-10" alt="avatar">
                        <div class="ml-4">
                            <div class="line-clamp-6">
                                <span class="font-semibold">{{ $notification->data['user_name'] }}</span>
                                comented on
                                <span>
                                    {{ $notification->data['idea_title'] }}
                                </span>:
                                <span>
                                    "{{ $notification->data['comment_body'] }}"
                                </span>

                            </div>
                            <div class="text-xs text-gray-500 mt-2">{{ $notification->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                </li>

            @endforeach

            <li class="border-t border-gray-300 text-center">
                <button 
                    wire:click="markAllAsRead"
                    @click="show = false"
                    class="w-full block font-semibold hover:bg-gray-100 px-5 py-4">
                    Mark all as read
                </button>
            </li>   
        @elseif($isLoading) {{-- if loading time is big we put placeholder animation --}}
            @foreach (range(1, 3) as $item)
                <li class="animate-pulse flex items-center transition duration-150 ease-in px-5 py-3">
                    <div class="bg-gray-200 rounded-xl w-10 h-10"></div>
                    <div class="flex-1 ml-4 space-y-2">
                        <div class="bg-gray-200 w-full rounded h-4"></div>
                        <div class="bg-gray-200 w-full rounded h-4"></div>
                        <div class="bg-gray-200 w-1/2 rounded h-4"></div>
                    </div>
                </li>
            @endforeach
        @else
            <div class="mx-auto w-40 py-6">
                <img src="{{ asset('img/no-ideas.svg') }}" alt="No Ideas" class="mx-auto mix-blend-luminosity">
                <div class="text-gray-400 text-center font-bold mt-6">No new notifications </div>
            </div>
        @endif
    </ul>
</div>
