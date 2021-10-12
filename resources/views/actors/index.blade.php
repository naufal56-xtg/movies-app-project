@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-12">
    <div class="popular-actors">
        <h2 class="uppercase tracking-wider text-yellow-500 text-lg  font-semibold">Popular Actors</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($popularActors as $actor)
            <div class="actor mt-8">
                <a href="{{ route('actors.show', $actor['id']) }}">
                    <img src="{{  $actor['profile_path'] }}" alt=""
                        class="hover:opacity-75 transition ease-in-out duration-150">
                </a>
                <div class="mt-2">
                    <a href="{{ route('actors.show', $actor['id']) }}"
                        class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                    <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{-- End Popular Actors --}}
    <div class="page-load-status my-8">
        <div class="flex justify-center">
            <div class="infinite-scroll-request spinner my-8 text-4xl">&nsbsp;</div>
            <p class="infinite-scroll-last text-2xl">End of content</p>
            <p class="infinite-scroll-error text-2xl">Error</p>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
<script>
    let elem = document.querySelector('.grid');
    let infScroll = new InfiniteScroll( elem, {
    // options
    path: '/actors/page/@{{#}}',
    append: '.actor',
    status: '.page-load-status'
    // history: false,
});
</script>
@endsection