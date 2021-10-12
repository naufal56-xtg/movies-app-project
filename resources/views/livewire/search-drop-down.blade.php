<div>
    <div class="relative mt-3 md:mt-0" x-data="{ open: true }" @click.away="open = false">
        <input type="text" wire:model.debounce.500ms='search'
            class="bg-gray-800 rounded-full w-64 px-4 py-1 pl-8 focus:outline-none focus:shadow" placeholder="Search"
            x-ref="search" @keydown.window="
            if (event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        " @focus="open = true" @keydown.escape.window="open = false" @keydown.shift.tab="open = false"
            @keydown="open = true">
        <div class="absolute top-0">
            <svg class="fill-current w-4 text-gray-400 mt-2 ml-2" viewBox="0 0 24 24">
                <path class="heroicon-ui"
                    d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z" />
            </svg>
        </div>


        @if (strlen($search) >= 2)
        <div class="absolute bg-gray-800 rounded w-64 mt-4 z-50" x-show.transition.opacity="open">
            @if ($searchResults->count() > 0 )
            <ul>
                @foreach ($searchResults as $result)
                <li class="border-b bg-gray-700">
                    @if (isset($result['poster_path']) && isset($result['title']))
                    <a href="{{ route('movies.show', $result['id']) }}"
                        class="block px-3 py-3 flex items-center transition ease-in-out delay-150" @if ($loop->last)
                        @keydown.tab="open = false" @endif
                        >
                        @if (isset($result['poster_path']))
                        <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="" class="w-8">
                        @else
                        <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                        @endif
                        @if (isset($result['title']) )
                        <span class="ml-4">{{ $result['title'] }}</span>
                        @else
                        <span class="ml-4">{{ $result['name'] }}</span>
                        @endif
                    </a>
                    @else
                    <a href="{{ route('tv.show', $result['id']) }}"
                        class="block px-3 py-3 flex items-center transition ease-in-out delay-150" @if ($loop->last)
                        @keydown.tab="open = false" @endif
                        >
                        @if (isset($result['poster_path']))
                        <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="" class="w-8">
                        @else
                        <img src="https://via.placeholder.com/50x75" alt="poster" class="w-8">
                        @endif
                        @if (isset($result['name']) )
                        <span class="ml-4">{{ $result['name'] }}</span>
                        @else
                        <span class="ml-4">{{ $result['title'] }}</span>
                        @endif
                    </a>
                    @endif

                </li>
                @endforeach
            </ul>
            @else
            <div class="px-3 py-3">No Results For "{{ $search }}"</div>
            @endif
        </div>
        @endif
    </div>
</div>