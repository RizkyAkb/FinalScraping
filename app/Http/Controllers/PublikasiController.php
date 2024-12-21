<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publikasi;

class PublikasiController extends Controller
{
    public function getPublicationData()
    {
        $data = Publikasi::selectRaw("strftime('%Y', publication_date) as year, COUNT(*) as total")
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        return response()->json($data);
    }

}
