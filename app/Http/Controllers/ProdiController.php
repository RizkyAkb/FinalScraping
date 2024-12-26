<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Publikasi;

class ProdiController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang login
        $source = $request->get('source');

        if (!$user || $user->role !== 'prodi') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil ID prodi pengguna
        $prodiId = $user->prodi_id;

        // Hitung jumlah dosen dalam prodi
        $dosen = User::where('role', 'dosen')->where('prodi_id', $prodiId)->get();
        $dosenz = $dosen->count();

        // Hitung jumlah artikel berdasarkan prodi pengguna
        $artikel = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->where('users.prodi_id', $prodiId)
            ->count();

        // Filter data publikasi untuk grafik
        $dosenId = $request->get('dosen_id');

        $publikasiQuery = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->selectRaw("
        CASE 
            WHEN LENGTH(publication_date) = 4 THEN publication_date 
            WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date) 
            ELSE NULL 
        END as year,
        COUNT(*) as total")
            ->where('users.prodi_id', $prodiId);

        if ($dosenId) {
            $publikasiQuery->where('users.id', $dosenId);
        }
        if ($source) {
            $publikasiQuery->where('publikasis.source', $source);
        }

        $publikasiData = $publikasiQuery
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        // Jika permintaan AJAX, kembalikan data dalam format JSON
        if ($request->ajax()) {
            return response()->json($publikasiData);
        }

        return view('adminProdi.dashboard', compact('dosen', 'publikasiData', 'artikel', 'dosenz'));
    }

    public function statistik()
    {
        $artikels = Publikasi::take(1000)->get();
        return view('adminProdi.statistik', compact('artikels'));
    }

    public function listDosen()
    {
        $dosens = User::where('role', 'dosen')->where('prodi_id', Auth::user()->prodi_id)->with('prodi')->get();
        return view('adminProdi.listDosen', compact('dosens'));
    }

    // View tambah Prodi (View-Create)
    public function create()
    {
        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        return view('prodi.add', compact('prodi', 'fakultas'));
    }

    // Menambah Prodi ke database (Create)
    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required|string',
            'prodi_name' => 'required|string|max:255',
            'year_founded' => 'required|integer',
        ]);

        Prodi::create([
            'fakultas_id' => $request->fakultas_id,
            'prodi_name' => $request->prodi_name,
            'year_founded' => $request->year_founded,
        ]);

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.listProdi')->with('success', 'Data berhasil dihapus');
        } elseif (auth()->user()->role === 'fakultas') {
            return redirect()->route('fakultas.listProdi')->with('success', 'Data berhasil dihapus');
        }
    }

    // View tambah Prodi (View-Create)
    public function edit($id)
    {
        $prodi = Prodi::findOrFail($id);
        $fakultas = Fakultas::all();
        return view('prodi.edit', compact('prodi', 'fakultas'));
    }

    // Mengupdate Prodi dari database (Update)
    public function update(Request $request, $id)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'fakultas_id' => 'required|string',
            'prodi_name' => 'required|string|max:255',
            'year_founded' => 'required|integer',
        ]);

        $prodi = Prodi::findOrFail($id);
        $prodi->update($validatedData);
        // Redirect ke halaman daftar dosen dengan pesan sukses
        return redirect()->route('prodi.edit', $id)->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus Prodi dari database (Delete)
    public function destroy($id)
    {
        $prodi = Prodi::findOrFail($id);
        $prodi->delete();

        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.listProdi')->with('success', 'Data berhasil dihapus');
        } elseif (auth()->user()->role === 'fakultas') {
            return redirect()->route('fakultas.listProdi')->with('success', 'Data berhasil dihapus');
        }
    }
}
