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
        $this->karyawanYangAkanBerangkat = UserSiteLocation::where('tgl_keberangkatan', '>=', Carbon::now())
            ->where('tgl_keberangkatan', '<=', Carbon::now()->addDays(7))
            ->with('user.profile', 'siteLocation')
            ->count();
        $this->karyawanYangAkanKembali = UserSiteLocation::where('tgl_kembali', '>=', Carbon::now())
            ->where('tgl_kembali', '<=', Carbon::now()->addDays(7))
            ->with('user.profile', 'siteLocation')
            ->count();
    }

    public function render()
    {
        return view('dashboard.index');
    }
}
