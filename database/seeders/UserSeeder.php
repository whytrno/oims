<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'email' => 'admin@gmail.com',
            'password' => Crypt::encryptString('password'),
        ]);

        $admin->assignRole('admin');

        Profile::create([
            'user_id' => $admin->id,
            'nama' => 'admin',
        ]);

        $manager = User::create([
            'email' => 'manager@gmail.com',
            'password' => Crypt::encryptString('password'),
        ]);

        $manager->assignRole('manager');

        Profile::create([
            'user_id' => $manager->id,
            'nama' => 'manager',
        ]);

        $user = User::create([
            'email' => 'user@gmail.com',
            'password' => Crypt::encryptString('password'),
        ]);

        $user->assignRole('user');

        Profile::create([
            'user_id' => $user->id,
            'nama' => 'user',
        ]);
    }
}
