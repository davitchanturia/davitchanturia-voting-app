<div 
    id="comment-{{ $comment->id }}"
    class="@if ($comment->is_status_update) is-status-update {{ 'status-'.Str::kebab($comment->status->name) }}@endif 
    comment-container bg-white rounded-xl z-auto relative flex flex-1 transition duration-500 ease-in"
>

    <div class="flex flex-col md:flex-row flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{ $comment->user->getAvatar() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
            @if ($comment->user->isAdmin())
                <div class="text-center uppercase text-blue text-xxs font-bold mt-1">Admin</div>
            @endif
        </div>

        <div class="md:mx-4 w-full">

            <div class="text-gray-600 ">
                @admin
                    @if ($comment->spam_reports > 0)   
                       <div class="text-red mb-2">
                           Spam Reports: {{ $comment->spam_reports}}    
                       </div>
                    @endif
                @endadmin

                @if ($comment->is_status_update)
                    <h4 class="text-xl font-semibold mb-3">
                        Status Changed to "{{ $comment->status->name }}"
                    </h4>
                @endif
                <div>
                    {{ $comment->body }}
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs font-semibold space-x-2 text-gray-400">
                    <div class="font-bold text-gray-900 @if ($comment->is_status_update) text-blue @endif">
                        {{ $comment->user->name }}
                    </div>
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
                        class="text-gray-900 flex items-center space-x-2"
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
                                            class="hover:bg-gray-100 px-5 py-3 block">
                                            Edit Comment
                                        </a>
                                    </li>
                                @endcan
                                @can('delete', $comment)
                                    <li>
                                        <a @click.prevent="
                                               show = false
                                               Livewire.emit('setDeleteComment', {{ $comment->id }})
                                            " 
                                            class="hover:bg-gray-100 px-5 py-3 block">
                                            Delete Comment
                                        </a>
                                    </li>
                                @endcan                             
                                {{-- @can('delete', $comment) --}}
                                    <li>
                                        <a @click.prevent="
                                               show = false
                                               Livewire.emit('setMarkAsSpamComment', {{ $comment->id }})
                                            " 
                                            class="hover:bg-gray-100 px-5 py-3 block">
                                            Mark as Spam
                                        </a>
                                    </li>
                                {{-- @endcan   --}}
                                @admin
                                @if ($comment->spam_reports > 0)
                                    {{-- @can('delete', $comment) --}}
                                    <li>
                                        <a @click.prevent="
                                               show = false
                                               Livewire.emit('setMarkAsNotSpamComment', {{ $comment->id }})
                                            " 
                                            class="hover:bg-gray-100 px-5 py-3 block">
                                            Mark as Not Spam
                                        </a>
                                    </li>
                                    {{-- @endcan   --}}
                                @endif
                                @endadmin
                            </ul>
                        </div>

                    </div>
                @endauth

            </div>
        </div>
    </div>

</div>
