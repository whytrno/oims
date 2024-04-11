<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Profile;
use App\Models\UserSiteLocation;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ResponseTraits;

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users,email',
            'role_id' => 'nullable|exists:roles,id',
            'password' => 'required|string|min:8',
            'password_confirm' => 'required|same:password',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            if ($this->isApi()) {
                return $this->validationFailedResponse($validator->errors(), null, 422);
            } else {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        try {
            $user = User::create([
                'role_id' => $request->role_id ?? 3,
                'email' => $request->email,
                'password' => Crypt::encryptString($request->password)
            ]);

            Profile::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
            ]);

            if ($this->isApi()) {
                return $this->successResponse($user, 'Register success', 200);
            } else {
                return redirect()->route('login')->with('success', 'Register success');
            }
        } catch (\Exception $e) {
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage(), 500);
            } else {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function loginProcess(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();

            if (!$user || $request->password !== Crypt::decryptString($user->password)) {
                if ($this->isApi()) {
                    return $this->failedResponse('Email or password is wrong', 401);
                } else {
                    return redirect()->back()->with('error', 'Email or password is wrong');
                }
            }

            if ($this->isApi()) {
                $token = $user->createToken('auth_token')->plainTextToken;
                return $this->successResponse($token, 'Login success', 200);
            } else {
                Auth::guard("web")->login($user);
                return redirect()->route('dashboard')->with('success', 'Login success');
            }
        } catch (\Exception $e) {
            dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage(), 500);
            } else {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function profile()
    {
        $data = User::with(['profile', 'role'])->where('id', auth()->user()->id)->first();

        if ($data->profile->foto) {
            $data->profile->foto = asset('storage/' . $data->profile->foto);
        }

        $type = 'profile';

        return view('users.detail', compact('data', 'type'));
    }

    public function updateProfile(Request $request)
    {
        $user = Profile::where('user_id', Auth::user()->id)->first();

        $validator = Validator::make($request->all(), [
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nama' => 'nullable|string|max:255',
            'no_hp' => 'nullable|integer',
            'nik' => 'nullable|size:16|unique:profiles,nik,' . $user->id . ',id',
            'tempat_lahir' => 'nullable|string|max:255',
            'anak' => 'nullable|integer',
            'tgl_lahir' => 'nullable|date',
            'alamat_ktp' => 'nullable|string|max:255',
            'domisili' => 'nullable|string|max:255',
            'agama' => 'nullable|in:islam,kristen,katolik,hindu,budha,konghucu',
            'status_pernikahan' => 'nullable|in:belum menikah,menikah,cerai',
            'kontak_darurat' => 'nullable|string|max:255',
            'mcu' => 'nullable|in:ada,tidak ada',
            'no_rek_bca' => 'nullable|size:10',
            'pendidikan_terakhir' => 'nullable|in:sd,smp,sma,d3,s1,s2,s3',
            'tgl_bergabung' => 'nullable|date',
            'nrp' => 'nullable|string|max:255',
            'no_kontrak' => 'nullable|integer',
            'status_kontrak' => 'nullable|in:aktif,tidak aktif',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user->update([
                'foto' => $request->file('foto') ? $request->file('foto')->store('profile', 'public') : $user->foto,
                'nama' => $request->nama ? $request->nama : $user->nama,
                'no_hp' => $request->no_hp ? $request->no_hp : $user->no_hp,
                'nik' => $request->nik,
                'tempat_lahir' => $request->tempat_lahir,
                'anak' => $request->anak,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat_ktp' => $request->alamat_ktp,
                'domisili' => $request->domisili,
                'agama' => $request->agama,
                'status_pernikahan' => $request->status_pernikahan,
                'kontak_darurat' => $request->kontak_darurat,
                'mcu' => $request->mcu,
                'no_rek_bca' => $request->no_rek_bca,
                'pendidikan_terakhir' => $request->pendidikan_terakhir,
                'tgl_bergabung' => $request->tgl_bergabung,
                'nrp' => $request->nrp,
                'no_kontrak' => $request->no_kontrak,
                'status_kontrak' => $request->status_kontrak,
            ]);

            UserSiteLocation::create([
                'user_id' => Auth::user()->id,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
            ]);

            return redirect()->back()->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            if (env('APP_DEBUG')) dd($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function logout()
    {
        try {
            Auth::guard("web")->logout();
            return redirect()->route('login')->with('success', 'Logout success');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
