<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\User;

class FakultasController extends Controller
{
    public function dashboard()
    {        
        $prodi = Prodi::count();
        $dosen = User::where('role', 'dosen')->count();
        $artikel = Fakultas::count();
        return view('adminFakultas.dashboard', compact('prodi','dosen','artikel'));
    }
    
    public function listProdi()
    {
        $prodis = Prodi::where('fakultas_id', Auth::user()->fakultas_id)->with('fakultas')->get();
        return view('adminFakultas.listProdi', compact('prodis'));
    }

    public function listDosen()
    {
        $dosens = User::where('role', 'dosen')->where('fakultas_id', Auth::user()->fakultas_id)->with('prodi')->get();
        return view('adminFakultas.listDosen', compact('dosens'));
    }

    public function listAdminProdi()
    {
        $admins = User::where('role', 'prodi')->where('fakultas_id', Auth::user()->fakultas_id)->with(['prodi', 'fakultas'])->get();
        return view('adminFakultas.listAdminProdi', compact('admins'));
    }
}
