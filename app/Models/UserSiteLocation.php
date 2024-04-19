<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSiteLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'site_location_id',
        'tgl_keberangkatan',
        'tgl_kembali',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siteLocation()
    {
        return $this->belongsTo(SiteLocation::class);
    }
}
