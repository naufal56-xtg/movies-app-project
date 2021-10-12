@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 pt-12">
    <div class="popular-series">
        <h2 class="uppercase tracking-wider text-yellow-500 text-lg  font-semibold">Popular Series</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($popularSeries as $series)
            <x-tv-card :series="$series"></x-tv-card>
            @endforeach
        </div>
    </div>
    {{-- End Popular Movies --}}

    <div class="top-rated-series py-24">
        <h2 class="uppercase tracking-wider text-yellow-500 text-lg  font-semibold">Top Rated Series</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
            @foreach ($topSeries as $series)
            <x-tv-card :series="$series"></x-tv-card>
            @endforeach
        </div>
    </div>
</div>
@endsection