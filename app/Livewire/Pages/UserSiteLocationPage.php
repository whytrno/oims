<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\On;

class UserSiteLocationPage extends Component
{
    public $tgl_keberangkatan = '';
    public $tgl_kembali = '';

    #[On('filter')]
    public function filter()
    {
//        dd($this->tgl_keberangkatan, $this->tgl_kembali);
        $this->dispatch('refresh-filter', tgl_keberangkatan: $this->tgl_keberangkatan, tgl_kembali: $this->tgl_kembali);
    }

    public function render()
    {
        return view('dashboard.users.sites.index');
    }
}
