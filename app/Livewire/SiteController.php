<?php

namespace App\Livewire;

use App\Models\SiteLocation;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class SiteController extends Component
{
    public $_page = 'view';

    public function render()
    {
        return view('dashboard.sites.index');
    }
}
