<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Progress extends Component
{
    public $value;
    public $max;

    public function __construct($value = 0, $max = 100)
    {
        $this->value = $value;
        $this->max = $max;
    }

    public function render()
    {
        return view('components.progress');
    }
}
