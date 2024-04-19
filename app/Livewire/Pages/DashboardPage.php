<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\User;
use App\Models\UserSiteLocation;
use Illuminate\Support\Carbon;

class DashboardPage extends Component
{
    public $karyawan = 0;
    public $karyawanYangAkanBerangkat = 0;
    public $karyawanYangAkanKembali = 0;

    public function mount()
    {
        $this->karyawan = User::count();
        $this->karyawanYangAkanBerangkat = UserSiteLocation::where('tgl_keberangkatan', '>=', Carbon::now()->subDays(7))->count();
        $this->karyawanYangAkanKembali = UserSiteLocation::where('tgl_kembali', '<=', Carbon::now()->addDays(7))->count();
    }

    public function render()
    {
        return view('dashboard.index');
    }
}
