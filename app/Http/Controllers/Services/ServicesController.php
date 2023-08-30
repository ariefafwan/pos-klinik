<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Services';
        return view('services.dashboard', compact('page'));
    }
}
