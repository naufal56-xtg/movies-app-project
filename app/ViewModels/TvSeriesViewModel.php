<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvSeriesViewModel extends ViewModel
{
    public $popularSeries, $topSeries, $genres;
    public function __construct($popularSeries, $topSeries, $genres)
    {
        $this->popularSeries = $popularSeries;
        $this->topSeries = $topSeries;
        $this->genres = $genres;
    }

    public function popularSeries()
    {
        return $this->formatSeries($this->popularSeries);
    }

    public function topSeries()
    {
        return $this->formatSeries($this->topSeries);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatSeries($series)
    {
        // @foreach ($series['genre_ids'] as $genre)
        //     {{ $genres->get($genre) }} @if (!$loop->last), @endif
        //     @endforeach
        return collect($series)->map(function ($series) {
            $genresFormat = collect($series['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');
            return collect($series)->merge([
                'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $series['poster_path'],
                'vote_average' => $series['vote_average'],
                'first_air_date' => Carbon::parse($series['first_air_date'])->format('M d, Y'),
                'genres' => $genresFormat,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        });
    }
}
