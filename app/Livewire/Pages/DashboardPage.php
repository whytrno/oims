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
        //         SELECT user_site_locations.id, profiles.nama as user_name, site_locations.name as site_location_name, user_site_locations.tgl_keberangkatan, user_site_locations.tgl_kembali FROM user_site_locations
        // JOIN users ON users.id = user_site_locations.user_id
        // JOIN profiles ON profiles.user_id = users.id
        // JOIN site_locations ON site_locations.id = user_site_locations.site_location_id
        // WHERE user_site_locations.tgl_keberangkatan >= CURDATE()
        $this->karyawanYangAkanBerangkat = UserSiteLocation::where('tgl_keberangkatan', '>=', Carbon::now()->subDays(1))->count();
        $this->karyawanYangAkanKembali = UserSiteLocation::where('tgl_kembali', '<=', Carbon::now()->addDays(7))->count();
    }

    public function render()
    {
        return view('dashboard.index');
    }
}
