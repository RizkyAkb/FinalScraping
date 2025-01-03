<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fakultas;
use App\Models\Publikasi;
use App\Models\Prodi;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $faculties = Fakultas::all();
        $prodies = Prodi::all();
        $fakultas = Fakultas::count();
        $prodi = Prodi::count();
        $dosen = User::where('role', 'dosen')->get(); // Ambil semua dosen
        $dosenz = $dosen->count();
        $artikel = Publikasi::count();

        $fakultasId = $request->get('fakultas_id');
        $prodiId = $request->get('prodi_id');
        $dosenId = $request->get('dosen_id');
        $source = $request->get('source');


        $publikasiQuery = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->selectRaw("
            CASE 
                WHEN LENGTH(publication_date) = 4 THEN publication_date 
                WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date) 
                ELSE NULL 
            END as year,
            COUNT(*) as total
        ");


        if ($fakultasId) {
            $publikasiQuery->where('users.fakultas_id', $fakultasId);
        }

        if ($prodiId) {
            $publikasiQuery->where('users.prodi_id', $prodiId);
        }

        if ($dosenId) {
            $publikasiQuery->where('users.id', $dosenId); // Perbaiki filter untuk dosen
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

        return view('adminUniv.dashboard', compact('fakultas', 'prodi', 'artikel', 'publikasiData', 'faculties', 'prodies', 'dosen', 'dosenz'));
    }


    public function statistik(Request $request)
    {
        $artikels = Publikasi::all();
        $fakultasId = $request->get('fakultas_id');
        $prodiId = $request->get('prodi_id');
        $year = $request->get('year'); // Ambil tahun dari request
        $years = DB::table('publikasis')
            ->selectRaw("CASE 
                    WHEN LENGTH(publication_date) = 4 THEN publication_date
                    WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date)
                    ELSE NULL
                END as year")
            ->whereNotNull('publication_date')
            ->whereRaw("CASE 
                    WHEN LENGTH(publication_date) = 4 THEN publication_date
                    WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date)
                    ELSE NULL
                END IS NOT NULL")
            ->distinct()
            ->orderBy('year', 'desc')
            ->get()
            ->unique('year'); // Menghindari duplikasi tahun


        $publikasiQuery = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->selectRaw("
            CASE
                WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date) 
                WHEN LENGTH(publication_date) = 4 THEN publication_date
                ELSE NULL
            END as year,
            COUNT(*) as total
        ");

        // Filter jika tahun dipilih
        if ($year) {
            $publikasiQuery->whereRaw("
            CASE
                WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date)
                WHEN LENGTH(publication_date) = 4 THEN publication_date
                ELSE NULL
            END = ?
        ", [$year]);
        }

        $publikasiData = $publikasiQuery
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();


        // Ambil data jumlah citation per prodi
        $dataProdi = Prodi::with(['user.publikasi' => function ($query) use ($year) {
            if ($year) {
                $query->whereYear('publication_date', $year);
            }
            $query->selectRaw('author_id, SUM(citations) as total_citation')->groupBy('author_id');
        }])->get();

        // Ambil data jumlah citation per fakultas
        $dataFakultas = Fakultas::with(['user.publikasi' => function ($query) use ($year) {
            if ($year) {
                $query->whereYear('publication_date', $year);
            }
            $query->selectRaw('author_id, SUM(citations) as total_citation')->groupBy('author_id');
        }])->get();

        // Hitung chart data untuk prodi
        $chartDataProdi = $dataProdi->map(function ($prodi) {
            $totalCitation = $prodi->user->reduce(function ($carry, $user) {
                return $carry + $user->publikasi->sum('total_citation');
            }, 0);

            return [
                'prodi' => $prodi->prodi_name,
                'citation' => $totalCitation,
            ];
        });

        $chartDataFakultas = $dataFakultas->map(function ($fakultas) {
            $totalCitation = $fakultas->user->reduce(function ($carry, $user) {
                return $carry + $user->publikasi->sum('total_citation');
            }, 0);

            return [
                'fakultas' => $fakultas->fakultas_name,
                'citation' => $totalCitation,
            ];
        });


        // Jika Anda ingin menduplikasi logika untuk publikasiData2
        $publikasiData2 = $publikasiQuery->get(); // Dapatkan data yang sama atau sesuaikan sesuai kebutuhan

        if ($request->ajax()) {
            // Kirim data chart sesuai dengan filter yang diminta
            $filteredData = [
                'chartDataProdi' => $chartDataProdi,
                'chartDataFakultas' => $chartDataFakultas
            ];
            return response()->json($filteredData);
        }


        return view('adminUniv.statistik', compact('artikels', 'chartDataProdi', 'chartDataFakultas', 'years', 'publikasiData', 'publikasiData2'));
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

    public function report()
    {
        return view('user.scrapeTahun');
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

        $role = auth()->user()->role;

        if ($role == 'admin') {
            return redirect()->route('admin.listDosen')->with('success', 'Data berhasil ditambahkan');
        } elseif ($role == 'fakultas') {
            return redirect()->route('fakultas.listDosen')->with('success', 'Data berhasil ditambahkan');
        } elseif ($role == 'prodi') {
            return redirect()->route('prodi.listDosen')->with('success', 'Data berhasil ditambahkan');
        }
    }

    // View tambah User (View-Create)
    public function editDosen($id)
    {
        $user = User::findOrFail($id);
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('user.edit', compact('user', 'fakultas', 'prodis'));
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

        $role = auth()->user()->role;

        if ($role == 'admin') {
            return redirect()->route('admin.listDosen')->with('success', 'Data berhasil dihapus');
        } elseif ($role == 'fakultas') {
            return redirect()->route('fakultas.listDosen')->with('success', 'Data berhasil dihapus');
        } elseif ($role == 'prodi') {
            return redirect()->route('prodi.listDosen')->with('success', 'Data berhasil dihapus');
        }
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

        $role = auth()->user()->role;

        if ($role == 'admin') {
            return redirect()->route('admin.listAdminProdi')->with('success', 'Data berhasil ditambahkan');
        } elseif ($role == 'fakultas') {
            return redirect()->route('fakultas.listAdminProdi')->with('success', 'Data berhasil ditambahkan');
        }
    }

    // View tambah User (View-Create)
    public function editAdmProdi($id)
    {
        $user = User::findOrFail($id);
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('adminProdi.edit', compact('user', 'fakultas', 'prodis'));
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

        $role = auth()->user()->role;

        if ($role == 'admin') {
            return redirect()->route('admin.listAdminProdi')->with('success', 'Data berhasil dihapus');
        } elseif ($role == 'fakultas') {
            return redirect()->route('fakultas.listAdminProdi')->with('success', 'Data berhasil dihapus');
        }
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
        return redirect()->route('admin.listAdminFakultas')->with('success', 'Data berhasil ditambahkan');
    }

    // View tambah User (View-Create)
    public function editAdmFakultas($id)
    {
        $user = User::findOrFail($id);
        $fakultas = Fakultas::all();
        $prodis = Prodi::all();
        return view('adminFakultas.edit', compact('user', 'fakultas', 'prodis'));
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

        return redirect()->route('admin.listAdminFakultas')->with('success', 'Data berhasil dihapus');
    }
}
