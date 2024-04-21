<?php

namespace App\Livewire\Modals;

use App\Models\SiteLocation;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;
use Masmerise\Toaster\Toaster;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\UserSiteLocation;

class CreateUserSiteLocation extends ModalComponent
{
    public $_disabled = true;
    public $data = [];
    public $user_id = '';
    public $id = '';
    public $site_location_id = '';
    public $tgl_keberangkatan = '';
    public $tgl_kembali = '';

    public $type = 'create';

    public function updated($field)
    {
        $this->validateOnly($field, [
            'user_id' => 'required|exists:users,id',
            'site_location_id' => 'required|exists:site_locations,id',
            'tgl_keberangkatan' => 'required',
            'tgl_kembali' => 'required',
        ]);
    }

    #[On('dataUpdated')]
    public function updatePostList()
    {
        $this->data = UserSiteLocation::orderBy('id', 'DESC')->get();
    }

    public function update()
    {
        try {
            UserSiteLocation::where('id', $this->id)->update([
                'user_id' => $this->user_id,
                'site_location_id' => $this->site_location_id,
                'tgl_keberangkatan' => $this->tgl_keberangkatan,
                'tgl_kembali' => $this->tgl_kembali,
            ]);

            $this->reset();
            $this->dispatch('refresh');
            Toaster::success('Data berhasil diubah');
        } catch (\Throwable $th) {
            dd($th);
            Toaster::error('Data gagal diubah, mohon lengkapi seluruh data');
        }
    }

    public function create()
    {
        try {
            UserSiteLocation::create([
                'user_id' => $this->user_id,
                'site_location_id' => $this->site_location_id,
                'tgl_keberangkatan' => $this->tgl_keberangkatan,
                'tgl_kembali' => $this->tgl_kembali,
            ]);

            $this->reset();
            $this->dispatch('refresh');
            Toaster::success('Data berhasil disimpan');
        } catch (\Throwable $th) {
            Toaster::error('Data gagal disimpan, mohon lengkapi seluruh data');
        }
    }

    public function render()
    {
        $userOptions = User::join('profiles', 'users.id', '=', 'profiles.user_id')
            ->pluck('profiles.nama', 'users.id')->toArray();
        $siteLocationOptions = SiteLocation::pluck('name', 'id')->toArray();

        return view('components.modals.createUserSiteLocation', [
            'data' => $this->data,
            'userOptions' => $userOptions,
            'siteLocationOptions' => $siteLocationOptions
        ]);
    }
}
