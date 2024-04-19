<?php

namespace App\Data;

class Options
{
    public function mcuOptions()
    {
        return [
            'ada' => 'Ada',
            'tidak ada' => 'Tidak Ada'
        ];
    }

    public function agamaOptions()
    {
        return [
            'islam' => 'Islam',
            'kristen' => 'Kristen',
            'katolik' => 'Katolik',
            'hindu' => 'Hindu',
            'budha' => 'Budha',
            'konghucu' => 'Konghucu'
        ];
    }

    public function statusPernikahanOptions()
    {
        return [
            'belum menikah' => 'Belum Menikah',
            'menikah' => 'Menikah',
            'cerai' => 'Cerai'
        ];
    }

    public function pendidikanTerakhirOptions()
    {
        return [
            'sd' => 'SD',
            'smp' => 'SMP',
            'sma' => 'SMA',
            'd3' => 'D3',
            's1' => 'S1',
            's2' => 'S2',
            's3' => 'S3'
        ];
    }

    public function statusKontrakOptions()
    {
        return [
            'aktif' => 'Aktif',
            'tidak aktif' => 'Tidak Aktif'
        ];
    }
}
