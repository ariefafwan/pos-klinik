<?php

namespace App\Http\Controllers\Apoteker;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApotekerController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Apoteker';
        return view('apoteker.dashboard', compact('page'));
    }
}
