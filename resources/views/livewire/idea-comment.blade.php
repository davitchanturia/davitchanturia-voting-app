<div class="comment-container bg-white rounded-xl z-auto relative flex flex-1 transition duration-500 ease-in">

    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>

        <div class="md:mx-4 w-full">

            <div class="text-gray-600 ">
                {{ $comment->body }}
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                    <div class="font-bold text-gray-900">{{ $comment->user->name }}</div>
                    <div>&bull;</div>
                    {{-- @if ($comment->user->id === $comment->idea->user->id) --}}
                    @if ($comment->user->id === $ideaUserId)
                        <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
                        <div>&bull;</div>
                    @endif
                    <div>{{ $comment->created_at->diffForHumans() }}</div>
                </div>

                @auth
                    <div x-data="{ show: false }" 
                        class="flex items-center space-x-2"
                    >
                        <div class="relative">
                            <button
                                class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 py- px-3
                                transition duration-150 ease-in"
                                @click="show = !show">
                                <svg fill="currentColor" width="24" height="6">
                                    <path d="M2.97.061A2.969 
                                        2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 
                                        0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 
                                        10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)">
                                </svg>
                            </button>
                            <ul class="absolute  z-50 w-44 text-left font-semibold text-sm bg-white shadow-dialog rounded-t-xl py-3 right-0 top-8 md:left-0 md:top-6 md:ml-8 "
                                x-cloak x-show.transition.origin.top.left="show"
                                @click.away="show = false">
                                @can('update', $comment)
                                    <li>
                                        <a @click.prevent="
                                               show = false
                                               Livewire.emit('setEditComment', {{ $comment->id }})
                                               {{-- $dispatch('custom-show-edit-modal') ვაგზავნით ივენთს --}}
                                            " 
                                            href="#" class="hover:bg-gray-100 px-5 py-3 block">
                                            Edit Comment
                                        </a>
                                    </li>
                                @endcan
                                <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Delete Comment</a> </li>
                                <li> <a href="#" class="hover:bg-gray-100 px-5 py-3 block">Mark as spam</a> </li>
                            </ul>
                        </div>

                    </div>
                @endauth

            </div>
        </div>
    </div>

</div>
