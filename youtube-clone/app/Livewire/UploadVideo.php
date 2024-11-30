<?php

namespace App\Livewire;

use Livewire\Attribute\On;
use Livewire\Component;

class UploadVideo extends Component
{
    public bool $modal = false;

    protected $listeners = ['toggleModal'];

    public function toggleModal()
    {
        $this->modal = !$this->modal;
    }

    public function render()
    {
        return view('livewire.upload-video');
    }
}

