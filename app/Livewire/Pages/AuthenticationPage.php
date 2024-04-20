<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Masmerise\Toaster\Toaster;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class AuthenticationPage extends Component
{
    public $_page = 'login';

    public $email;
    public $password;
    public $nama;
    public $password_confirmation;
    public $no_hp;

    protected $loginRules = [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8',
    ];

    protected $registerRules = [
        'email' => 'required|string|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'password_confirmation' => 'required|same:password',
        'nama' => 'required|string|max:255',
        'no_hp' => 'required|string|max:255',
    ];

    public function updated($propertyName)
    {
        if ($this->_page === 'login') {
            $this->validateOnly($propertyName, $this->loginRules);
        } else {
            $this->validateOnly($propertyName, $this->registerRules);
        }
    }

    public function changePage($page)
    {
        $this->_page = $page;
    }

    public function login()
    {
        try {
            $user = User::where('email', $this->email)->first();

            if (!$user || $this->password !== Crypt::decryptString($user->password)) {
                Toaster::error('Email or password is wrong');
            } else {
                Auth::login($user);
                return redirect()->route('dashboard')->success('Login success');
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function register()
    {
        try {
            $user = User::create([
                'role_id' => $this->role_id ?? 3,
                'email' => $this->email,
                'password' => Crypt::encryptString($this->password)
            ]);

            Profile::create([
                'user_id' => $user->id,
                'nama' => $this->nama,
                'no_hp' => $this->no_hp,
            ]);

            $this->changePage('login');

            Toaster::success('Register success');
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function formSubmit()
    {
        if ($this->_page === 'login') {
            $this->validate($this->loginRules);
            $this->login();
        } else {
            $this->validate($this->registerRules);
            $this->register();
        }
    }

    public function render()
    {
        return view('authentication')->layout('layouts.authentication');
    }
}
