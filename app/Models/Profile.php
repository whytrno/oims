<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'foto',
        'nama',
        'no_hp',
        'nik',
        'tempat_lahir',
        'tgl_lahir',
        'alamat_ktp',
        'domisili',
        'agama',
        'status_pernikahan',
        'anak',
        'nama_kontak_darurat',
        'hubungan_kontak_darurat',
        'no_kontak_darurat',
        'mcu',
        'foto_mcu',
        'foto_ktp',
        'no_rek_bca',
        'pendidikan_terakhir',
        'tgl_bergabung',
        'nrp',
        'no_kontrak',
        'status_kontrak',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
