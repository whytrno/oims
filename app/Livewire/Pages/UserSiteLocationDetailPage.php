<?php

namespace App\Livewire\Pages;

use App\Models\SiteLocation;
use App\Models\UserSiteLocation;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Livewire\Attributes\On;

class UserSiteLocationDetailPage extends Component
{
    public $_disabled = true;
    public $userId;
    public $data;
    public $site_location_id = '';
    public $tgl_keberangkatan = '';
    public $tgl_kembali = '';

    public function mount($userId)
    {
        if (auth()->user()->hasRole('admin')) {
            $this->_disabled = false;
        }

        $this->userId = $userId;
        $this->data = UserSiteLocation::where('user_id', $this->userId)->orderBy('id', 'DESC')->get();
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'site_location_id' => 'required|exists:site_locations,id',
            'tgl_keberangkatan' => 'required',
            'tgl_kembali' => 'required',
        ]);
    }

    #[On('dataUpdated')]
    public function updatePostList()
    {
        $this->data = UserSiteLocation::where('user_id', $this->userId)->orderBy('id', 'DESC')->get();
    }

    public function create()
    {
        try {
            UserSiteLocation::create([
                'user_id' => $this->userId,
                'site_location_id' => $this->site_location_id,
                'tgl_keberangkatan' => $this->tgl_keberangkatan,
                'tgl_kembali' => $this->tgl_kembali,
            ]);

            $this->reset(['site_location_id', 'tgl_keberangkatan', 'tgl_kembali']);
            $this->dispatch('dataUpdated');
            Toaster::success('Data berhasil disimpan');
        } catch (\Throwable $th) {
            Toaster::error('Data gagal disimpan, mohon lengkapi seluruh data');
        }
    }

    public function render()
    {
        $siteLocationOptions = SiteLocation::pluck('name', 'id')->toArray();

        return view('dashboard.users.sites.detail', [
            'data' => $this->data,
            'siteLocationOptions' => $siteLocationOptions
        ]);
    }
}
