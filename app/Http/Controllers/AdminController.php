<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Helper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index()
    {
        try {
            return view('site.admin.dashboard');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "Could not load the page");
        }
    }

    public function getUsers(Request $request)
    {
        try {
            return view('site.admin.users.index');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "Could not load the page");
        }
    }
    /**
     * Server Table User Table
     * @param Request $request
     * @return void
     * Models
     * @return User
     */
    public function getUserAjaxServerTable(Request $request)
    {
        try {
            $query = User::whereNot('role_id', [1]);
            $filteredCount = $query->count();
            $data = $query->skip($request->input('start'))->take($request->input('length'))->get();
            $formattedData = [];
            foreach ($data as $key => $user) {
                $actionColumn = '<div class="p-4 d-flex">
                            <div class="form-switch">
                                <input class="form-check-input toggle-class" data-id="' . $user->id . '"type="checkbox" role="switch"' . ($user->active ? ' checked' : '') . ' />
                            </div>
                            <i class="fa-solid fa-pen-to-square hover-scale text-success me-4 fs-3 cursor-pointer" onclick="editUser(\'' . $user->id . '\',\'' . $user->name . '\',\'' . $user->email . '\',\'' . $user->phone_number . '\',)"></i>
                            <i class="fa-solid fa-trash hover-scale text-danger me-4 fs-3 cursor-pointer" onclick="deleteUser(\'' . $user->id . '\',)"></i>
                </div>';


                $formattedData[] = [
                    'no' => $key + 1,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone_number' => $user->phone_number,
                    'action' => $actionColumn,
                ];
            }
            $response = [
                'draw' => $request->input('draw'),
                'recordsTotal' => $data->count(),
                'recordsFiltered' => $filteredCount,
                'data' => $formattedData,
            ];
            return response()->json($response);
        } catch (Exception $e) {
            Log::error($e);
            return Helper::responseOnFailure();
        }
    }
    /**
     * Change Status of User On the basis of id
     * @param request->id
     * Model
     * @return User
     */
    public function postChangeUserStatus(Request $request)
    {
        try {
            $User = User::find($request->id);
            $User->active = $request->activeStatus;
            $User->save();
            return Helper::responseOnSuccess([
                'message' => $User->active ? 'User Activate successfully.' : 'User De-activated successfully.',
                'data' => [],
                'method' => 'POST'
            ]);
        } catch (Exception $e) {
            Log::error($e);
            return Helper::responseOnFailure();
        }
    }
    /**
     * Update the USer detail name,email,phone and password
     * @param request->id
     * Model
     * @return User
     */
    public function postUpdateUser(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:users,id',
                'name' => 'required',
                'phone_number' => 'required',
            ]);
            if ($validator->fails()) {
                Log::error($validator->errors()->first());
                return Helper::responseOnValidationFailure([$validator->errors()->first()]);
            } else {
                $user = User::find($request['id']);
                if ($user) {
                    $user->update([
                        'name' => $request['name'],
                        'phone_number' => $request['phone_number'],
                    ]);
                    if ($request->has('password') && $request->password !== null) {
                        $user->password = bcrypt($request->password);
                        $user->save();
                    }
                }
                return Helper::responseOnSuccess([
                    'message' => 'User Updated SuccessFUlly ',
                    'data' => [],
                    'method' => 'POST'
                ]);
            }
        } catch (Exception $e) {
            Log::error($e);
            return Helper::responseOnFailure();
        }
    }

    public function postDeleteuser(Request $request)
    {
        try {
            // dd($request->all());
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:users,id',
            ]);
            if ($validator->fails()) {
                Log::error($validator->errors()->first());
                return Helper::responseOnValidationFailure([$validator->errors()->first()]);
            } else {
                User::where('id', $request['id'])->delete();
                $responseData = [
                    'message' => 'User Deleted SucccessFully',
                    'data' => null,
                    'method' => 'POST',
                    "status" => 200,
                ];
                return Helper::responseOnSuccess($responseData);
            }
        } catch (Exception $e) {
            dd($e);
            Log::error($e);
            return Helper::responseOnFailure();
        }
    }
}
