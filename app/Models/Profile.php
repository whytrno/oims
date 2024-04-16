<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFotoAttribute($value)
    {
        // Cek jika foto ada
        if ($value) {
            // Jika ada, kembalikan URL lengkap foto
            return asset('storage/' . $value);
        }

        // Jika tidak ada, kembalikan null atau URL default jika ada
        return null; // Atau sesuaikan dengan URL default Anda
    }
}
