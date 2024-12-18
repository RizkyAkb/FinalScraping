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

    // View tambah Fakultas (View-Create)
    public function create()
    {
        $fakultas = Fakultas::all();        
        return view('fakultas.add', compact('fakultas'));
    }

    // Menambah Fakultas ke database (Create)
    public function store(Request $request)
    {
        $request->validate([
            'fakultas_name' => 'required|string|max:255',            
        ]);

        Fakultas::create([
            'fakultas_name' => $request->fakultas_name,            
        ]);
        return redirect()->route('admin.listFakultas')->with('success', 'Data berhasil ditambahkan');
    }

    // View tambah Fakultas (View-Create)
    public function edit($id)
    {
        $fakultas = Fakultas::findOrFail($id);        
        return view('fakultas.edit', compact('fakultas'));
    }

    // Mengupdate Fakultas dari database (Update)
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'fakultas_name' => 'required|string|max:255',            
        ]);

        $fakultas = Fakultas::findOrFail($id); 
        $fakultas->update($validatedData); 
        // Redirect ke halaman daftar dosen dengan pesan sukses
        return redirect()->route('fakultas.edit', $id)->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus Fakultas dari database (Delete)
    public function destroy($id)
    {
        $fakultas = Fakultas::findOrFail($id);
        $fakultas->delete();

        return redirect()->route('admin.listFakultas')->with('success', 'Data berhasil dihapus');
    }
}
