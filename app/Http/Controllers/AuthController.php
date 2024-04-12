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
