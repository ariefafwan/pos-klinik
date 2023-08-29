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
        $role = Auth::user()->role_id;
        if ($role == 1) {
            return redirect()->to('admin/dashboard');
        } else if ($role == 2) {
            return redirect()->to('user/dashboard');
        } else if ($role == 3) {
            return redirect()->to('user/dashboard');
        } else {
            return redirect()->to('logout');
        }
    }
}
