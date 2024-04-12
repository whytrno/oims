<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseTraits;
use App\Models\UserSiteLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SiteController extends Controller
{
    use ResponseTraits;

    public function index($id = null)
    {
        try {
            if (!$id) {
                $id = auth()->user()->id;
            }

            $data = UserSiteLocation::where('user_id', $id)->get();

            if ($this->isApi()) {
                return $this->successResponse($data);
            } else {
                return view('sites.index', compact('data'));
            }
        } catch (\Throwable $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    public function store(Request $request, $userId = null)
    {
        try {
            if (!$userId) {
                $userId = auth()->user()->id;
            }

            $validator = Validator::make($request->all(), $this->validatorRules());

            if ($validator->fails()) {
                if ($this->isApi()) {
                    return $this->failedResponse($validator->errors());
                } else {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('toast_message', 'Some validation errors, please check again');
                }
            }

            UserSiteLocation::create([
                'user_id' => $userId,
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
            ]);

            if ($this->isApi()) {
                return $this->successResponse('Data has been saved');
            } else {
                return redirect()->back()->with('toast_message', 'Data has been saved');
            }
        } catch (\Throwable $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), $this->validatorRules());

            if ($validator->fails()) {
                if ($this->isApi()) {
                    return $this->failedResponse($validator->errors());
                } else {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('toast_message', 'Some validation errors, please check again');
                }
            }

            $data = new UserSiteLocation();

            if (Auth::user()->hasRole('user')) {
                $data = $data->where('user_id', Auth::user()->id)->where('id', $id)->first();
            } else {
                $data = $data->where('id', $id)->first();
            }

            if (!$data) {
                if ($this->isApi()) {
                    return $this->failedResponse('Data not found');
                } else {
                    return redirect()->back()->with('toast_message', 'Data not found');
                }
            }

            $data->update([
                'provinsi' => $request->provinsi,
                'kabupaten' => $request->kabupaten,
            ]);

            if ($this->isApi()) {
                return $this->successResponse('Data has been updated');
            } else {
                return redirect()->back()->with('toast_message', 'Data has been updated');
            }
        } catch (\Throwable $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    public function destroy($id)
    {
        try {
            $data = new UserSiteLocation();

            if (Auth::user()->hasRole('user')) {
                $data = $data->where('user_id', Auth::user()->id)->where('id', $id)->first();
            } else {
                $data = $data->where('id', $id)->first();
            }

            if (!$data) {
                if ($this->isApi()) {
                    return $this->failedResponse('Data not found');
                } else {
                    return redirect()->back()->with('toast_message', 'Data not found');
                }
            }

            $data->delete();

            if ($this->isApi()) {
                return $this->successResponse('Data has been deleted');
            } else {
                return redirect()->back()->with('toast_message', 'Data has been deleted');
            }
        } catch (\Throwable $e) {
            if (env('APP_DEBUG')) dd($e);
            if ($this->isApi()) {
                return $this->failedResponse($e->getMessage());
            } else {
                return redirect()->back()->with('toast_message', $e->getMessage());
            }
        }
    }

    private function validatorRules()
    {
        return [
            'provinsi' => 'required',
            'kabupaten' => 'required',
        ];
    }
}
