<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\User;
use App\Models\Publikasi;

class FakultasController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang login
        if (!$user || $user->role !== 'fakultas') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil ID fakultas pengguna
        $fakultasId = $user->fakultas_id;

        // Filter data prodi dan dosen berdasarkan fakultas pengguna
        $prodies = Prodi::where('fakultas_id', $fakultasId)->get();
        $dosen = User::where('role', 'dosen')->where('fakultas_id', $fakultasId)->get();
        $prodi = $prodies->count();
        $dosenz = $dosen->count();
        $source = $request->get('source');

        // Hitung jumlah artikel yang terkait dengan fakultas
        $artikel = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->where('users.fakultas_id', $fakultasId)
            ->count();

        // Filter data publikasi untuk chart
        $prodiId = $request->get('prodi_id');
        $dosenId = $request->get('dosen_id');

        $publikasiQuery = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->selectRaw("
        CASE 
            WHEN LENGTH(publication_date) = 4 THEN publication_date 
            WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date) 
            ELSE NULL 
        END as year,
        COUNT(*) as total")
            ->where('users.fakultas_id', $fakultasId);

        if ($prodiId) {
            $publikasiQuery->where('users.prodi_id', $prodiId);
        }

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

        return view('adminFakultas.dashboard', compact('prodies', 'dosen', 'publikasiData', 'prodi', 'artikel', 'dosenz'));
    }

    public function report()
    {        
        return view('user.scrapeTahun');
    }

    public function statistik()
    {
        $fakultas_id = Auth::user()->fakultas_id;
        $artikels = Publikasi::whereHas('user', function ($query) use ($fakultas_id) {
            $query->where('fakultas_id', $fakultas_id);
        })->get();


        // Ambil data jumlah citation per prodi
        $dataFakultas = Fakultas::with(['user.publikasi' => function ($query) {
            $query->selectRaw('author_id, SUM(citations) as total_citation')->groupBy('author_id');
        }])->get();        

        $chartDataFakultas = $dataFakultas->map(function ($fakultas) {
            $totalCitation = $fakultas->user->reduce(function ($carry, $user) {
                return $carry + $user->publikasi->sum('total_citation');
            }, 0);

            return [
                'fakultas' => $fakultas->fakultas_name, // Kolom nama fakultas
                'citation' => $totalCitation,
            ];
        });

        return view('adminFakultas.statistik', compact('artikels', 'chartDataFakultas'));
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
            'year_founded' => 'required|integer',
        ]);

        Fakultas::create([
            'fakultas_name' => $request->fakultas_name,
            'year_founded' => $request->year_founded,
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
            'year_founded' => 'required|integer',
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
