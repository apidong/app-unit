<?php

namespace App\Http\Controllers\Web\Penjualan;

use Illuminate\Http\Request;
use App\Models\SettingAplikasi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class ExpedisiController extends Controller
{
    function getRates(Request $request)
    {
        $pelanggan = $request->pelanggan;
        $alamat = $request->alamat;
        $item = $request->item;
        $kurir = SettingAplikasi::where('key', 'couriers')->first();
        $url = SettingAplikasi::where('key', 'url_biteship')->first();
        $token = SettingAplikasi::where('key', 'token_biteship')->first();

        $response = Http::withHeaders([
            'authorization' => $token,
            'content-type' => 'application/json'
        ])->get($url . '/v1/rates/couriers', [
            'origin_postal_code' => 'Steve',
            'role' => 'Network Administrator',
        ]);

        $this->sendResponse();
    }
}
