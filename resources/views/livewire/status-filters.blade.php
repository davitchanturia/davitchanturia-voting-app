 <div>
    <nav class="hidden md:flex items-center justify-between text-xs">
            <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3 text-gray-400">
                <li>
                    <a wire:click.prevent="setStatus('All')" 
                        href="{{ route('idea.index', ['status' => 'All']) }}" class="border-b-4 pb-3 hover:border-blue  transition duration-150 ease-in @if ($status === 'All') border-blue text-gray-900 @endif">
                        All Ideas ({{$statusCount['all_statuses']}})
                    </a>
                </li>
                <li>
                    <a wire:click.prevent="setStatus('Considering')"
                         href="{{ route('idea.index', ['status' => 'Considering']) }}" class=" border-b-4 pb-3 @if ($status === 'Considering') border-blue text-gray-900 @endif
                            transition duration-150 ease-in hover:border-blue" >
                         Considering ({{$statusCount['considering']}})
                    </a>
                </li>
                <li>
                    <a wire:click.prevent="setStatus('In Progress')" 
                        href="{{ route('idea.index', ['status' => 'In Progress']) }}" class=" border-b-4 pb-3 @if ($status === 'In Progress') border-blue text-gray-900 @endif
                         transition duration-150 ease-in hover:border-blue" >
                        In Progress ({{$statusCount['in_progress']}})
                    </a>
                </li>
            </ul>

            <ul class="flex uppercase font-semibold border-b-4 pb-3 space-x-10 text-gray-400">
                <li>
                    <a wire:click.prevent="setStatus('Implemented')" 
                        href="{{ route('idea.index', ['status' => 'Implemented']) }}" class=" border-b-4 pb-3 @if ($status === 'Implemented') border-blue text-gray-900 @endif
                         transition duration-150 ease-in hover:border-blue" >
                        Implemented ({{$statusCount['implemented']}})
                    </a>
                </li>
                <li>
                    <a wire:click.prevent="setStatus('Closed')"
                     href="{{ route('idea.index', ['status' => 'Closed']) }}" class=" border-b-4 pb-3 @if ($status === 'Closed') border-blue text-gray-900 @endif
                     transition duration-150 ease-in hover:border-blue" >
                        Closed ({{$statusCount['closed']}})
                    </a>
                </li>
            </ul>
    </nav>
</div>
