<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Traits\ResponseTraits;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use ResponseTraits;

    public function index()
    {
        try {
            $data = User::with(['profile'])->get();

            foreach ($data as $user) {
                $user->password = Crypt::decryptString($user->password);
                if ($user->profile->foto) {
                    $user->profile->foto = asset('storage/' . $user->profile->foto);
                    $user->profile->foto_ktp = asset('storage/' . $user->profile->foto_ktp);
                    $user->profile->foto_mcu = asset('storage/' . $user->profile->foto_mcu);
                }
            }

            return view('users.index', compact('data'));
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    public function create()
    {
        $type = 'create';
        $roleOptions = Role::pluck('name', 'id')->toArray();

        return view('users.detail', compact('type', 'roleOptions'));
    }

    public function detail($id = null)
    {
        try {
            $type = 'update';

            if (Auth::user()->hasRole('manager')) {
                $type = 'read';
            } elseif (Auth::user()->hasRole('user')) {
                $type = 'profile';
            }

            if (!$id) {
                $id = auth()->user()->id;
            }

            $data = User::with(['profile', 'siteLocation'])->where('id', $id)->first();
            $roleOptions = Role::pluck('name', 'id')->toArray();
            $userRoles = $data->getRoleNames();

            if ($data->profile->foto) {
                $data->profile->foto = asset('storage/' . $data->profile->foto);
            }

            if ($this->isApi()) {
                $data->role = $userRoles;
                return $this->successResponse($data, 'Get profile success', 200);
            } else {
                return view('users.detail', compact('id', 'type', 'data', 'roleOptions', 'userRoles'));
            }
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->validatorRules());

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('toast_message', 'Some validation errors, please check again');
        }

        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Crypt::encryptString($request->password),
            ]);

            $roleId = Role::where('id', $request->role_id)->first();
            $user->assignRole($roleId);

            Profile::create($this->profileRequest($request, null, $user->id));

            return redirect()->back()->with('toast_message', 'User created successfully');
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    public function update(Request $request, $id = null)
    {
        if (!$id) {
            $id = auth()->user()->id;
        }

        $validator = Validator::make($request->all(), $this->validatorRules($id));

        if ($validator->fails()) {
            if ($this->isApi()) {
                return $this->failedResponse($validator->errors());
            } else {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('toast_message', 'Profile updated successfully with errors');
            }
        }

        try {
            $user = User::with(['profile'])->where('id', $id)->first();

            if ($request->filled('role_id')) {
                $roleId = Role::where('id', $request->role_id)->first();
                $user->syncRoles([$roleId]);
            }

            $user->update([
                'email' => $request->filled('email') ? $request->email : $user->email,
                'password' => $request->filled('password') ? Crypt::encryptString($request->password) : $user->password,
            ]);


            $user->profile->update($this->profileRequest($request, $user));

            if ($this->isApi()) {
                return $this->successResponse($user, 'Profile updated successfully', 200);
            } else {
                return redirect()->back()->with('toast_message', 'Profile updated successfully');
            }
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return redirect()->back()->with('toast_message', 'User deleted successfully');
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    public function export()
    {
        try {
            return Excel::download(new UsersExport, 'users.xlsx');
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }


    private function validatorRules($userId = null)
    {
        $rules = [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string',
            'nik' => 'nullable|size:16|unique:profiles,nik,' . ($userId ? $userId : '') . ',user_id',
            'tempat_lahir' => 'nullable|string|max:255',
            'tgl_lahir' => 'nullable|date',
            'alamat_ktp' => 'nullable|string|max:255',
            'domisili' => 'nullable|string|max:255',
            'agama' => 'nullable|in:islam,kristen,katolik,hindu,budha,konghucu',
            'status_pernikahan' => 'nullable|in:belum menikah,menikah,cerai',
            'anak' => 'nullable|required_if:status_pernikahan,menikah,cerai|integer|min:0',
            'nama_kontak' => 'nullable|string|max:255',
            'hubungan_kontak' => 'nullable|string|max:255',
            'no_kontak_darurat' => 'nullable|string|max:255',
            'mcu' => 'nullable|in:ada,tidak ada',
            'foto_mcu' => 'nullable|required_if:mcu,ada|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_rek_bca' => 'nullable|size:10',
            'pendidikan_terakhir' => 'nullable|in:sd,smp,sma,d3,s1,s2,s3',
            'tgl_bergabung' => 'nullable|date',
            'nrp' => 'nullable|string|max:255',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'no_kontrak' => 'nullable|integer',
            'status_kontrak' => 'nullable|in:aktif,tidak aktif',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|required_with:provinsi|string|max:255',
        ];

        if (!$userId) {
            $rules['role_id'] = 'required|integer|exists:roles,id';
            $rules['email'] = 'required|email|unique:users,email,' . ($userId ? $userId : '');
            $rules['password'] = 'required|min:8|confirmed';
            $rules['password_confirmation'] = 'required|min:8';
        } else {
            $rules['role_id'] = 'nullable|integer|exists:roles,id';
            $rules['email'] = 'nullable|email|unique:users,email,' . ($userId ? $userId : '');
            $rules['password'] = 'nullable|min:8|confirmed';
            $rules['password_confirmation'] = 'nullable|min:8';
        }

        return $rules;
    }

    private function setFile($request, $file, $path)
    {
        if ($request->file($file)) {
            $path =  $request->file($file)->store($path, 'public');
            $path = asset('storage/' . $path);

            return $path;
        }

        return null;
    }

    private function profileRequest($request, $user = null, $id = null)
    {
        $foto = $user ? $user->foto : null;
        $foto_mcu = $user ? $user->foto_mcu : null;
        $foto_ktp = $user ? $user->foto_ktp : null;

        if ($request->file('foto')) {
            $foto = $this->setFile($request, 'foto', 'images/profile');
        }

        if ($request->file('foto_mcu')) {
            $foto_mcu = $this->setFile($request, 'foto_mcu', 'images/mcu');
        }

        if ($request->file('foto_ktp')) {
            $foto_ktp = $this->setFile($request, 'foto_ktp', 'images/ktp');
        }

        $profileRequests = [
            'foto' => $foto,
            'nama' => $request->filled('nama') ? $request->nama : ($user ? $user->nama : null),
            'no_hp' => $request->filled('no_hp') ? $request->no_hp : ($user ? $user->no_hp : null),
            'nik' => $request->filled('nik') ? $request->nik : ($user ? $user->nik : null),
            'tempat_lahir' => $request->filled('tempat_lahir') ? $request->tempat_lahir : ($user ? $user->tempat_lahir : null),
            'anak' => $request->filled('anak') ? $request->anak : ($user ? $user->anak : null),
            'tgl_lahir' => $request->filled('tgl_lahir') ? $request->tgl_lahir : ($user ? $user->tgl_lahir : null),
            'alamat_ktp' => $request->filled('alamat_ktp') ? $request->alamat_ktp : ($user ? $user->alamat_ktp : null),
            'domisili' => $request->filled('domisili') ? $request->domisili : ($user ? $user->domisili : null),
            'agama' => $request->filled('agama') ? $request->agama : ($user ? $user->agama : null),
            'status_pernikahan' => $request->filled('status_pernikahan') ? $request->status_pernikahan : ($user ? $user->status_pernikahan : null),
            'nama_kontak_darurat' => $request->filled('nama_kontak_darurat') ? $request->nama_kontak_darurat : ($user ? $user->nama_kontak_darurat : null),
            'hubungan_kontak_darurat' => $request->filled('hubungan_kontak_darurat') ? $request->hubungan_kontak_darurat : ($user ? $user->hubungan_kontak_darurat : null),
            'no_kontak_darurat' => $request->filled('no_kontak_darurat') ? $request->no_kontak_darurat : ($user ? $user->no_kontak_darurat : null),
            'mcu' => $request->filled('mcu') ? $request->mcu : ($user ? $user->mcu : null),
            'foto_mcu' => $foto_mcu,
            'foto_ktp' => $foto_ktp,
            'no_rek_bca' => $request->filled('no_rek_bca') ? $request->no_rek_bca : ($user ? $user->no_rek_bca : null),
            'pendidikan_terakhir' => $request->filled('pendidikan_terakhir') ? $request->pendidikan_terakhir : ($user ? $user->pendidikan_terakhir : null),
            'tgl_bergabung' => $request->filled('tgl_bergabung') ? $request->tgl_bergabung : ($user ? $user->tgl_bergabung : null),
            'nrp' => $request->filled('nrp') ? $request->nrp : ($user ? $user->nrp : null),
            'no_kontrak' => $request->filled('no_kontrak') ? $request->no_kontrak : ($user ? $user->no_kontrak : null),
            'status_kontrak' => $request->filled('status_kontrak') ? $request->status_kontrak : ($user ? $user->status_kontrak : null),
        ];

        if ($id) {
            $profileRequests['user_id'] = $id;
        }

        return $profileRequests;
    }
}
