<?php

namespace App\Livewire;

use App\Http\Traits\UploadFile;
use App\Models\User;
use App\Models\Profile;
use App\Data\Options;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Masmerise\Toaster\Toaster;


class UserController extends Component
{
    use WithFileUploads, UploadFile;

    public $_page = 'view';
    public $_disabled = true;

    public $userId = null;

    public $role_name = '';
    public $role_id = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $nama = '';
    public $foto = '';
    public $no_hp = '';
    public $nik = '';
    public $tempat_lahir = '';
    public $tgl_lahir = '';
    public $alamat_ktp = '';
    public $domisili = '';
    public $agama = '';
    public $status_pernikahan = '';
    public $anak = '';
    public $nama_kontak_darurat = '';
    public $hubungan_kontak_darurat = '';
    public $no_kontak_darurat = '';
    public $mcu = '';
    public $foto_mcu = '';
    public $foto_ktp = '';
    public $no_rek_bca = '';
    public $pendidikan_terakhir = '';
    public $tgl_bergabung = '';
    public $nrp = '';
    public $no_kontrak = '';
    public $status_kontrak = '';

    public function mount($userId = null)
    {
        $this->userId = $userId;

        if ($userId) {
            $this->_page = 'edit';

            if (auth()->user()->hasRole('admin')) {
                $this->_disabled = false;
            } elseif ($userId == auth()->user()->id) {
                $this->_disabled = false;
            }

            $user = User::where('id', $userId)->with('profile')->first();
            $role = Role::where('name', $user->getRoleNames()->first())->first();

            $this->role_name = $user->getRoleNames()->first();
            $this->role_id = $role->id;
            $this->email = $user->email;
            $this->nama = $user->profile->nama;
            $this->foto = $user->profile->foto;
            $this->no_hp = $user->profile->no_hp;
            $this->nik = $user->profile->nik;
            $this->tempat_lahir = $user->profile->tempat_lahir;
            $this->tgl_lahir = $user->profile->tgl_lahir;
            $this->alamat_ktp = $user->profile->alamat_ktp;
            $this->domisili = $user->profile->domisili;
            $this->agama = $user->profile->agama;
            $this->status_pernikahan = $user->profile->status_pernikahan;
            $this->anak = $user->profile->anak;
            $this->nama_kontak_darurat = $user->profile->nama_kontak_darurat;
            $this->hubungan_kontak_darurat = $user->profile->hubungan_kontak_darurat;
            $this->no_kontak_darurat = $user->profile->no_kontak_darurat;
            $this->mcu = $user->profile->mcu;
            $this->foto_mcu = $user->profile->foto_mcu;
            $this->foto_ktp = $user->profile->foto_ktp;
            $this->no_rek_bca = $user->profile->no_rek_bca;
            $this->pendidikan_terakhir = $user->profile->pendidikan_terakhir;
            $this->tgl_bergabung = $user->profile->tgl_bergabung;
            $this->nrp = $user->profile->nrp;
            $this->no_kontrak = $user->profile->no_kontrak;
            $this->status_kontrak = $user->profile->status_kontrak;
        }
    }

    public function changePage($page)
    {
        $this->_page = $page;
    }

    public function render()
    {
        switch ($this->_page) {
            case 'view':
                return view('dashboard.users.index');
            case 'edit':
                $options = new Options;
                $data = User::find($this->userId);
                $roles = Role::pluck('name', 'id')->toArray();
                $role = $data->getRoleNames()->first();

                return view(
                    'dashboard.users.detail',
                    [
                        'role' => $role,
                        'roles' => $roles,
                        'mcuOptions' => $options->mcuOptions(),
                        'agamaOptions' => $options->agamaOptions(),
                        'statusPernikahanOptions' => $options->statusPernikahanOptions(),
                        'pendidikanTerakhirOptions' => $options->pendidikanTerakhirOptions(),
                        'statusKontrakOptions' => $options->statusKontrakOptions(),
                    ]
                );
            default:
                return view('dashboard.users.index');
        }
    }

    // FORM
    protected function updateRules($userId = null)
    {
        return [
            'role_id' => 'nullable|integer|exists:roles,id',
            'email' => 'nullable|email|unique:users,email,' . $userId . ',id',
            'password' => 'nullable|min:8|confirmed',
            'password_confirmation' => 'nullable|min:8',

            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string',
            'nik' => 'nullable|size:16|unique:profiles,nik,' . $userId . ',user_id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'alamat_ktp' => 'nullable|string|max:255',
            'domisili' => 'nullable|string|max:255',
            'agama' => 'nullable|in:islam,kristen,katolik,hindu,budha,konghucu',
            'status_pernikahan' => 'nullable|in:belum menikah,menikah,cerai',
            'anak' => 'nullable|required_if:status_pernikahan,menikah,cerai|integer|min:0',
            'nama_kontak_darurat' => 'nullable|string|max:255',
            'hubungan_kontak_darurat' => 'nullable|string|max:255',
            'no_kontak_darurat' => 'nullable|string|max:255',
            'mcu' => 'nullable|in:ada,tidak ada',
            'foto_mcu' => 'nullable|required_if:mcu,ada|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'foto_mcu' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_rek_bca' => 'nullable|size:10',
            'pendidikan_terakhir' => 'nullable|in:sd,smp,sma,d3,s1,s2,s3',
            'tgl_bergabung' => 'nullable|date',
            'nrp' => 'nullable|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_kontrak' => 'nullable|integer',
            'status_kontrak' => 'nullable|in:aktif,tidak aktif',
        ];
    }

    public function updated($field)
    {
        if ($this->_page === 'view') {
            $this->validateOnly(
                $field,
                $this->updateRules,
            );
        } else {
            $this->validateOnly($field, $this->updateRules($this->userId));
        }
    }

    public function update()
    {
        try {
            $user = User::find($this->userId);
            $profile = Profile::where('user_id', $this->userId)->first();
            $role = Role::find($this->role_id);

            $updateUserData = [
                'email' => $this->email,
            ];

            if ($this->password) {
                if ($this->password === $this->password_confirmation) {
                    $updateUserData['password'] = bcrypt($this->password);
                }
            }

            $updateProfileData = [
                'nama' => $this->nama,
                'no_hp' => $this->no_hp,
                'nik' => $this->nik,
                'tempat_lahir' => $this->tempat_lahir,
                'tgl_lahir' => $this->tgl_lahir,
                'alamat_ktp' => $this->alamat_ktp,
                'domisili' => $this->domisili,
                'agama' => $this->agama,
                'status_pernikahan' => $this->status_pernikahan,
                'anak' => $this->anak,
                'nama_kontak_darurat' => $this->nama_kontak_darurat,
                'hubungan_kontak_darurat' => $this->hubungan_kontak_darurat,
                'no_kontak_darurat' => $this->no_kontak_darurat,
                'mcu' => $this->mcu,
                'no_rek_bca' => $this->no_rek_bca,
                'pendidikan_terakhir' => $this->pendidikan_terakhir,
                'tgl_bergabung' => $this->tgl_bergabung,
                'nrp' => $this->nrp,
                'no_kontrak' => $this->no_kontrak,
                'status_kontrak' => $this->status_kontrak,
            ];

            if ($this->foto) {
                $this->foto = $this->uploadFile($this->foto, 'public/images/profile');
                $updateProfileData['foto'] = $this->foto;
            } else {
                $updateProfileData['foto'] = $profile->foto;
            }

            if ($this->foto_mcu) {
                $this->foto_mcu = $this->uploadFile($this->foto_mcu, 'public/images/mcu');
                $updateProfileData['foto_mcu'] = $this->foto_mcu;
            } else {
                $updateProfileData['foto_mcu'] = $profile->foto_mcu;
            }

            if ($this->foto_ktp) {
                $this->foto_ktp = $this->uploadFile($this->foto_ktp, 'public/images/ktp');
                $updateProfileData['foto_ktp'] = $this->foto_ktp;
            } else {
                $updateProfileData['foto_ktp'] = $profile->foto_ktp;
            }

            $user->syncRoles($role);
            $user->update($updateUserData);
            $profile->update($updateProfileData);

            Toaster::success('Update successfully');
        } catch (\Throwable $th) {
            Toaster::error('Update failed');
        }
    }
}
