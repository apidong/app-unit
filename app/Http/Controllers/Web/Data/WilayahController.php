<?php

namespace App\Http\Controllers\Web\Data;

use App\Models\Wilayah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WilayahController extends Controller
{
     
    public function listWilayah(Request $request)
    {
        $this->validate($request, [
            'kode' => 'sometimes',
        ]);

        $provinsi = substr($request->kode, 0, 2);
        $kabupaten = substr($request->kode, 0, 5);
        $kecamatan = $request->kode;

        $desa = Wilayah::when(strlen($request->kode) == 8, function ($query) use ($request, $provinsi, $kabupaten, $kecamatan) {
                $query->listDesa($request, $provinsi, $kabupaten, $kecamatan);
            })
            ->when(strlen($request->kode) == 5, function ($query) use ($request, $provinsi, $kabupaten) {
                $query->listKecamatan($request, $provinsi, $kabupaten);
            })
            ->when(strlen($request->kode) == 2, function ($query) use ($request, $provinsi) {
                $query->listKabupaten($request, $provinsi);
            })
            ->unless($request->kode, function ($query) use ($request) {
                $query->listProvinsi($request);
            })
            ->paginate();

        return response()->json([
            'results' => $desa->items(),
            'pagination' => [
                'more' => $desa->currentPage() < $desa->lastPage(),
            ],
        ]);
    }
 
}
