<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $series;
    public function __construct($series)
    {
        $this->series = $series;
    }

    public function series()
    {
        return collect($this->series)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w500/' . $this->series['poster_path'],
            'name' => $this->series['name'],
            'vote_average' => $this->series['vote_average'],
            'first_air_date' => Carbon::parse($this->series['first_air_date'])->format('M d, Y'),
            'genres' => collect($this->series['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => collect($this->series['credits']['crew'])->take(5),
            'cast' => collect($this->series['credits']['cast'])->take(10),
            'images' => collect($this->series['images']['backdrops'])->take(9),
        ])->only([
            'poster_path', 'id', 'genre_ids', 'name', 'vote_average', 'overview', 'first_air_date', 'genres', 'images', 'cast', 'crew', 'videos', 'created_by',
        ]);
    }
}
