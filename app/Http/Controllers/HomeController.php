<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->active == 1) {
            if (Auth::user()->role_id == 1) {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role_id == 2) {
                return redirect()->route('user.dashboard');
            } else {
                return redirect()->to('logout')->with('error', "User Does not have the aceess to Web Login, cant login");
            }
            return redirect()->to('logout')->with('error', "User Suspended, cant login");
        } else {
            Auth::logout();
            return redirect()->back()->with('error', "User is Deactivated, cant login");
        }
    }
}
