<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        try {
            return view('site.user.dashboard');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', "Could not load the page");
        }
    }
    /**
     * GetProfile page
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        try {
            return view('site.user.profile');
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Coul not load the page');
        }
    }
    /**
     * Update User Profile
     *
     * @param  \Illuminate\Http\Request  
     * @return \Illuminate\Http\Response
     */
    public function postUpdateProfile(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required|exists:users,id',
                'name' => 'required',
                'phone_number' => 'required',
                'email' => 'required|exists:users,email',
                'password' => 'required',
                'password_confirmation' => 'required',
            ]);
            if ($validator->fails()) {
                Log::error(
                    $validator->errors()->first()
                );
                return back()->withErrors($validator->errors()->first())->withInput()->with('error', $validator->errors()->first());
            } else {
                User::where('id', $request['id'])->update([
                    'name' => $request['name'],
                    'phone_number' => $request['phone_number'],
                    'email' => $request['email'],
                    'password' => bcrypt($request['password']),
                ]);
                return redirect()->back()->with('success', 'Profile Updated SuccessFUlly');
            }
        } catch (Exception $e) {
            Log::error($e);
            return redirect()->back()->with('error', 'Coul not load the page');
        }
    }
}
