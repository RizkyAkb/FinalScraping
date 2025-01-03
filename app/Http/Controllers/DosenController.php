<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Publikasi;
use App\Models\User;
use Illuminate\Support\Facades\DB;


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

    public function statistik(Request $request)
    {
        // Get the articles of the current logged-in user
        $artikels = Publikasi::where('author_id', Auth::user()->id)->get();

        // Get the current logged-in user
        $user = Auth::user();

        // Get the dosen data in the same program (prodi)
        $dosenId = User::where('role', 'dosen') // Filter only 'dosen' role
            ->with(['publikasi' => function ($query) {
                $query->selectRaw('author_id, SUM(citations) as total_citation')
                    ->groupBy('author_id');
            }])
            ->get();

        // Get the selected year from the request
        $year = $request->get('year');
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
            ->unique('year'); // Avoid duplicates

        // Prepare the query for publication data
        $publikasiQuery = Publikasi::join('users', 'publikasis.author_id', '=', 'users.id')
            ->selectRaw("
            CASE
                WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date) 
                WHEN LENGTH(publication_date) = 4 THEN publication_date
                ELSE NULL
            END as year,
            COUNT(*) as total
        ");

        // If a year is selected, filter the data by the year
        if ($year) {
            $publikasiQuery->whereRaw("
                CASE
                    WHEN LENGTH(publication_date) = 10 THEN strftime('%Y', publication_date)
                    WHEN LENGTH(publication_date) = 4 THEN publication_date
                    ELSE NULL
                END = ? 
            ", [$year]);
        }


        // Get the publication data
        $publikasiData = $publikasiQuery->groupBy('year')->orderBy('year', 'asc')->get();

        // Get the dosen data with filtered citations based on year
        $dataDosen = User::with(['publikasi' => function ($query) use ($year) {
            if ($year) {
                $query->whereYear('publication_date', $year);
            }
            $query->selectRaw('author_id, SUM(citations) as total_citation')->groupBy('author_id');
        }])->get();

        // Map the dosen data and prepare the chart data
        $chartDataDosen = $dosenId->map(function ($dosen) {
            $totalCitation = $dosen->publikasi->sum('total_citation');
            return [
                'name' => $dosen->name,
                'citation' => $totalCitation,
            ];
        });

        // Prepare data for the second publication chart (optional, depends on your needs)
        $publikasiData2 = $publikasiQuery->get();

        // Return the data
        if ($request->ajax()) {
            // Kirim data chart sesuai dengan filter yang diminta
            $filteredData = [
                'chartDataDosen' => $chartDataDosen,
            ];
            return response()->json($filteredData);
        }

        return view('adminDosen.statistik', compact('artikels', 'chartDataDosen', 'years', 'publikasiData', 'publikasiData2'));
    }



    public function report()
    {
        return view('user.scrapeTahun');
    }
}
