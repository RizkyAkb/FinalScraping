<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\User;

class ProdiController extends Controller
{
    public function dashboard()
    {        
        $dosen = User::where('role', 'dosen')->where('prodi_id', Auth::user()->prodi_id)->count();
        $artikel = Fakultas::count();
        return view('adminProdi.dashboard', compact('dosen','artikel'));    
    }

    public function listDosen()
    {
        $dosens = User::where('role', 'dosen')->where('prodi_id', Auth::user()->prodi_id)->with('prodi')->get();
        return view('adminProdi.listDosen', compact('dosens'));
    }
}
