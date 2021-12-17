<div>
    @auth
    <form wire:submit.prevent="createIdea" action="#" method="post" class="space-y-4 px-4 py-6 ">
        @csrf

        <div>
            <input wire:model.defer="title" type="text"
                class="w-full text-sm border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2"
                placeholder="Your idea">

            @error('title')
                <p class="text-red text-xs mt-1"> {{ $message }} </p>
            @enderror
        </div>

        <div>
            <select wire:model.defer="category" name="category_add" id="category_add"
                class="w-full bg-gray-100 rounded-xl px-4 py-2 border-none text-sm">

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach

            </select>
        </div>
        @error('category')
            <p class="text-red text-xs mt-1"> {{ $message }} </p>
        @enderror

        <div>
            <textarea wire:model.defer="description" name="idea" id="idea" cols="30" rows="4"
                class="w-full bg-gray-100 rounded-xl placeholder-gray-900 text-sm px-4 py-2 border-none"
                placeholder="Describe your idea"></textarea>

            @error('description')
                <p class="text-red text-xs mt-1"> {{ $message }} </p>
            @enderror
        </div>
        <div class="flex items-center justify-between space-x-3">
            <button type="button"
                class="items-center justify-center w-1/2 h-11 flex text-sm bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400
                        transition duration-150 ease-in
            ">

                <svg class="w-4 text-gray-500 transform -rotate-45" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg>

                <span class="ml-1">Attach</span>
            </button>

            <button type="submit"
                class="items-center justify-center w-1/2 h-11 flex text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                        transition duration-150 ease-in
            ">
                <span class="ml-1">Submit</span>
            </button>

        </div>

    </form>
    @else 
    <div class="my-6 text-center">
        <a 
            wire:click.prevent="redirectToLogin"
            href="{{ route('login') }}"
            class="justify-center inline-block w-1/2 h-11 text-sm text-white bg-blue px-6 py-3 font-semibold rounded-xl border border-blue hover:bg-blue-hover
                    transition duration-150 ease-in
                ">
            Login
        </a>

        <a 
            wire:click.prevent="redirectToRegister"
            href="{{ route('register') }}"
            class="justify-center inline-block w-1/2 h-11 text-sm mt-2 bg-gray-200 px-6 py-3 font-semibold rounded-xl border border-gray-200 hover:border-gray-400
                    transition duration-150 ease-in
                ">
            Sign up
        </a>
    </div>
    @endauth
</div>
