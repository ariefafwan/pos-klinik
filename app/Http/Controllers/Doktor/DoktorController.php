<?php

namespace App\Http\Controllers\Doktor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoktorController extends Controller
{
    public function dashboard()
    {
        $page = 'Dashboard Doktor';
        return view('doktor.dashboard', compact('page'));
    }
}
