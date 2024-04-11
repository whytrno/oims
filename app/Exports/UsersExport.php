<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $counter = 1;
        return User::with('profile')->get()->map(function ($user) use (&$counter) {
            return [
                'No' => $counter++,
                'Nama' => $user->profile->nama,
                'No HP' => $user->profile->no_hp,
                'NIK' => $user->profile->nik,
                'Tempat Lahir' => $user->profile->tempat_lahir,
                'Tanggal Lahir' => $user->profile->tgl_lahir,
                'Alamat KTP' => $user->profile->alamat_ktp,
                'Domisili' => $user->profile->domisili,
                'Agama' => $user->profile->agama,
                'Status Pernikahan' => $user->profile->status_pernikahan,
                'Kontak Darurat' => $user->profile->kontak_darurat,
                'MCU' => $user->profile->mcu,
                'No Rek BCA' => $user->profile->no_rek_bca,
                'Pendidikan Terakhir' => $user->profile->pendidikan_terakhir,
                'Tanggal Bergabung' => $user->profile->tgl_bergabung,
                'NRP' => $user->profile->nrp,
                'No Kontrak' => $user->profile->no_kontrak,
                'Status Kontrak' => $user->profile->status_kontrak,
                'Lokasi Site' => $user->profile->lokasi_site,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'No HP',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Alamat KTP',
            'Domisili',
            'Agama',
            'Status Pernikahan',
            'Kontak Darurat',
            'MCU',
            'No Rek BCA',
            'Pendidikan Terakhir',
            'Tanggal Bergabung',
            'NRP',
            'No Kontrak',
            'Status Kontrak',
        ];
    }
}
