<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function dashboard()
    {
        return view('adminDosen.dashboard');
    }
}
