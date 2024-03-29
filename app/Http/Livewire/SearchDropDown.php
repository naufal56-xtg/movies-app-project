<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropDown extends Component
{
    public $search = '';
    public function render()
    {
        $searchResults = [];
        if (strlen($this->search) >= 2) {
            $searchResults = Http::withToken(config('services.tmdb.token'))
                ->get("https://api.themoviedb.org/3/search/multi?query=" . $this->search)
                ->json()['results'];
        }
        // dump($searchResults);
        return view('livewire.search-drop-down', [
            'searchResults' => collect($searchResults)->take(5),
        ]);
    }
}
