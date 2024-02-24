<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Region;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    /** @var Wilayah */
    protected $wilayah;

    public function __construct(Wilayah $wilayah)
    {
        $this->wilayah = $wilayah;
    }

    public function listWilayah(Request $request)
    {
        $this->validate($request, [
            'kode' => 'sometimes',
        ]);

        $provinsi = substr($request->kode, 0, 2);
        $kabupaten = substr($request->kode, 0, 5);
        $kecamatan = $request->kode;

        $desa = $this->wilayah
            ->when(strlen($request->kode) == 8, function ($query) use ($request, $provinsi, $kabupaten, $kecamatan) {
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
