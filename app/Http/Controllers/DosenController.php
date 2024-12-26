<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Publikasi;
use App\Models\User;

class DosenController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = Auth::user(); // Mendapatkan pengguna yang login

        if (!$user || $user->role !== 'dosen') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        $dosenId = $request->get('dosen_id');
        $source = $request->get('source');
        $artikel = Publikasi::where('author_id', $user->id)->count();

        // Query publikasi berdasarkan author_id pengguna yang login
        $publikasiQuery = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->selectRaw("
        CASE 
            WHEN LENGTH(publication_date) = 4 THEN publication_date 
            WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date) 
            ELSE NULL 
        END as year,
        COUNT(*) as total")
            ->where('users.id', $user->id); // Filter berdasarkan id pengguna yang login

        // Filter tambahan jika ada parameter dosen_id
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

        // Hitung jumlah artikel oleh dosen yang login

        return view('adminDosen.dashboard', compact('publikasiData', 'artikel'));
    }

    public function statistik()
    {
        $artikels = Publikasi::where('author_id', Auth::user()->id)->get();

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Ambil data dosen yang berada di prodi yang sama dengan user yang sedang login dan memiliki role 'dosen'
        $dosenInProdi = User::where('prodi_id', $user->prodi_id)
            ->where('role', 'dosen') // Filter hanya dengan role 'dosen'
            ->with(['publikasi' => function ($query) {
                $query->selectRaw('author_id, SUM(citations) as total_citation')
                    ->groupBy('author_id');
            }])
            ->get();

        // Mengumpulkan data dosen dan jumlah citation mereka
        $chartData = $dosenInProdi->map(function ($dosen) {
            return [
                'name' => $dosen->name, // Nama dosen
                'citation' => $dosen->publikasi->sum('total_citation'), // Total citation per dosen
            ];
        });

        return view('adminDosen.statistik', compact('artikels', 'chartData'));
    }

    public function report()
    {
        return view('user.scrapeTahun');
    }
}
