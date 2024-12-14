<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $fakultas = Fakultas::count();
        $prodi = Prodi::count();
        $dosen = User::where('role', 'dosen')->count();
        $artikel = Fakultas::count();
        return view('adminUniv.dashboard', compact('fakultas','prodi','dosen','artikel'));
    }

    public function statistik()
    {
        $faculties = Fakultas::all();
        return view('adminUniv.statistik', compact('faculties'));
    }


    public function listFakultas()
    {
        $faculties = Fakultas::all();
        return view('adminUniv.listFakultas', compact('faculties'));
    }

    public function listProdi()
    {
        $prodis = Prodi::with('fakultas')->get();
        return view('adminUniv.listProdi', compact('prodis'));
    }

    public function listDosen()
    {
        $dosens = User::where('role', 'dosen')->with('prodi')->get();
        return view('adminUniv.listDosen', compact('dosens'));
    }

    public function listAdminFakultas()
    {
        $admins = User::where('role', 'fakultas')->with('fakultas')->get();
        return view('adminUniv.listAdminFakultas', compact('admins'));
    }

    public function listAdminProdi()
    {
        $admins = User::where('role', 'prodi')->with(['prodi', 'fakultas'])->get();
        return view('adminUniv.listAdminProdi', compact('admins'));
    }
}
