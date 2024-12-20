<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Publikasi;

class AdminController extends Controller
{
    public function dashboard()
    {
        $fakultas = Fakultas::count();
        $prodi = Prodi::count();
        $dosen = User::where('role', 'dosen')->count();
        $artikel = Publikasi::count();
        return view('adminUniv.dashboard', compact('fakultas', 'prodi', 'dosen', 'artikel'));
    }

    public function statistik()
    {
        $artikels = Publikasi::take(10)->get();
        return view('adminUniv.statistik', compact('artikels'));
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

    // View tambah User (View-Create)
    public function tambahDosen()
    {
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('user.add', compact('fakultas', 'prodis'));
    }

    // Menambah User ke database (Create)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fakultas' => 'required|exists:fakultas,id',
            'prodi' => 'required|exists:prodis,id',
            'role' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'scholar_id' => 'required|string|max:255',
            'scopus_id' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'fakultas_id' => $request->fakultas,
            'prodi_id' => $request->prodi,
            'role' => $request->role,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'scholar_id' => $request->scholar_id,
            'scopus_id' => $request->scopus_id,
        ]);
        return redirect()->route('/')->with('success', 'Data berhasil ditambahkan');
    }

    // View tambah User (View-Create)
    public function editDosen($id)
    {
        $user = User::findOrFail($id);
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('user.edit', compact('user','fakultas', 'prodis'));
    }

    // Mengupdate User dari database (Update)
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fakultas_id' => 'required|string',
            'prodi_id' => 'required|string',
            'email' => 'required|email',
            'scholar_id' => 'nullable|string|max:255',
            'scopus_id' => 'nullable|string|max:255',
        ]);

        $user = User::findOrFail($id); 
        $user->update($validatedData); 
        // Redirect ke halaman daftar dosen dengan pesan sukses
        return redirect()->route('user.edit', $id)->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus User dari database (Delete)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('/')->with('success', 'Data berhasil dihapus');
    }

    // View tambah User (View-Create)
    public function tambahAdmProdi()
    {
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('adminProdi.add', compact('fakultas', 'prodis'));
    }

    // Menambah User ke database (Create)
    public function storeAdmProdi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fakultas' => 'required|exists:fakultas,id',
            'prodi' => 'required|exists:prodis,id',
            'role' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',            
        ]);

        User::create([
            'name' => $request->name,
            'fakultas_id' => $request->fakultas,
            'prodi_id' => $request->prodi,
            'role' => 'prodi',
            'email' => $request->email,
            'password' => bcrypt($request->password),            
        ]);
        return redirect()->route('/')->with('success', 'Data berhasil ditambahkan');
    }

    // View tambah User (View-Create)
    public function editAdmProdi($id)
    {
        $user = User::findOrFail($id);
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('adminProdi.edit', compact('user','fakultas', 'prodis'));
    }

    // Mengupdate User dari database (Update)
    public function updateAdmProdi(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fakultas_id' => 'required|string',
            'prodi_id' => 'required|string',
            'email' => 'required|email',            
        ]);

        $user = User::findOrFail($id); 
        $user->update($validatedData); 
        // Redirect ke halaman daftar dosen dengan pesan sukses
        return redirect()->route('adminProdi.edit', $id)->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus User dari database (Delete)
    public function destroyAdmProdi($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('/')->with('success', 'Data berhasil dihapus');
    }

    // View tambah User (View-Create)
    public function tambahAdmFakultas()
    {
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('adminFakultas.add', compact('fakultas', 'prodis'));
    }

    // Menambah User ke database (Create)
    public function storeAdmFakultas(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'fakultas' => 'required|exists:fakultas,id',            
            'role' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',            
        ]);

        User::create([
            'name' => $request->name,
            'fakultas_id' => $request->fakultas,            
            'role' => 'fakultas',
            'email' => $request->email,
            'password' => bcrypt($request->password),            
        ]);
        return redirect()->route('/')->with('success', 'Data berhasil ditambahkan');
    }

    // View tambah User (View-Create)
    public function editAdmFakultas($id)
    {
        $user = User::findOrFail($id);
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('adminFakultas.edit', compact('user','fakultas', 'prodis'));
    }

    // Mengupdate User dari database (Update)
    public function updateAdmFakultas(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'fakultas_id' => 'required|string',            
            'email' => 'required|email',            
        ]);

        $user = User::findOrFail($id); 
        $user->update($validatedData); 
        // Redirect ke halaman daftar dosen dengan pesan sukses
        return redirect()->route('adminFakultas.edit', $id)->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus User dari database (Delete)
    public function destroyAdmFakultas($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('/')->with('success', 'Data berhasil dihapus');
    }
}
