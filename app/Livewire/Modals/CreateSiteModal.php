<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use App\Models\SiteLocation;
use Masmerise\Toaster\Toaster;

class CreateSiteModal extends ModalComponent
{
    public $name = '';

    public function updated($field)
    {
        $this->validateOnly($field, [
            'name' => 'required|unique:site_locations,name',
        ]);
    }

    public function create()
    {
        try {
            SiteLocation::create([
                'name' => $this->name,
            ]);

            $this->reset();

            Toaster::success('Create data successfully');
            $this->dispatch('refresh');
            $this->closeModal();
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function render()
    {
        return view('components.modals.createSiteModal');
    }
}
