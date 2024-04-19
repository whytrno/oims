<?php

namespace App\Livewire\Pages;

use App\Models\SiteLocation;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class SiteLocationPage extends Component
{
    public $_page = 'view';

    public function render()
    {
        return view('dashboard.sites.index');
    }
}
