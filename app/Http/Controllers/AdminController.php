<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProfileToko;
use App\Models\ProfileWeb;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $page = "test";
        $toko = ProfileWeb::all();
        return view('admin.kasir.index', compact('page', 'toko'));
    }
}
