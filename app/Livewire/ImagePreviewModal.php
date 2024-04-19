<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class ImagePreviewModal extends ModalComponent
{
    public $image = '';

    public function render()
    {
        return view('components.imagePreviewModal');
    }
}
