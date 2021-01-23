<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnnounceController extends Controller
{
    public function index()
    {
        return view('announce');
    }
}
