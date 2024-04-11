<?php

namespace App\Http\Controllers;

use App\Models\UserSiteLocation;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index($id)
    {
        $data = UserSiteLocation::where('user_id', $id)->get();

        return view('sites.index', compact('data'));
    }
}
