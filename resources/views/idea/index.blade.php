<x-app-layout>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6 ">
        <div class="w-full md:w-1/3 ">

            <select name="category" id="category" 
                class="w-full rounded-xl px-4 py-2 border-none">
                @foreach ($categories as $category)
                    <option value="category one"> {{ $category->name }}</option>
                @endforeach
                
            </select>

        </div>

        <div class="w-full md:w-1/3">

            <select name="other_filters" id="other_filters" 
                class="w-full rounded-xl px-4 py-2 border-none">

                <option value="category one">category one</option>
                <option value="category two">category two</option>
                <option value="category three">category three</option>
                <option value="category four">category four</option>
                
            </select>

        </div>

        <div class="w-full md:w-2/3 relative ">

            <input type="search" placeholder="FInd an idea" 
                class="w-full rounded-xl bg-white px-4 py-2 pl-10 border-none placeholder-gray-900"
            >

            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

        </div>

    </div>


    <div class="ideas-container space-y-6 my-6">

 
        @foreach ($ideas as $idea)
            <livewire:idea-index 
                :idea="$idea" 
                :votesCount="$idea->votes_count" 
            />
        @endforeach
 
    </div>

    <div class="my-8">
        {{ $ideas->links() }}
    </div>

</x-app-layout>
