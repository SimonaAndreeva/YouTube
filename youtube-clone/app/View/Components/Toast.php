<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toast extends Component
{
    public $message;
    public $type;

    /**
     * Create a new component instance.
     *
     * @param string $message
     * @param string $type
     */
    public function __construct($message = 'Default toast message', $type = 'info')
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.toast');
    }
}
