<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UploadVideoForm extends Form
{
    #[Validate('required')]
    public string $title;

    #[Validate('required')]
    public string $description;

    #[Validate('required')]
    public string $tags;  

    public $thumbnail_path;

}
