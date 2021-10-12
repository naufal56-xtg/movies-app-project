<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TvCard extends Component
{
    public $series;
    public function __construct($series)
    {
        $this->series = $series;
    }

    public function render()
    {
        return view('components.tv-card');
    }
}
