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

        // Query publikasi berdasarkan author_id pengguna yang login
        $publikasiQuery = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->selectRaw("strftime('%Y', publication_date) as year, COUNT(*) as total")
            ->where('users.id', $user->id); // Filter berdasarkan id pengguna yang login

        // Filter tambahan jika ada parameter dosen_id
        $dosenId = $request->get('dosen_id');
        if ($dosenId) {
            $publikasiQuery->where('users.id', $dosenId);
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
        $artikel = Publikasi::where('author_id', $user->id)->count();

        return view('adminDosen.dashboard', compact('publikasiData', 'artikel'));
    }

    public function statistik()
    {
        $artikels = Publikasi::take(1000)->get();
        return view('adminDosen.statistik', compact('artikels'));
    }    
}
