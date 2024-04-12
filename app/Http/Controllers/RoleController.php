<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTraits;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use ResponseTraits;

    public function index()
    {
        try {
            $data = Role::all();

            return $this->successResponse('Data role berhasil diambil', $data);
        } catch (\Exception $e) {
            return $this->failedResponse($e->getMessage());
        }
    }
}
