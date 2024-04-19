<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }
}
