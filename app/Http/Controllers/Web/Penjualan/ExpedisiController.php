<?php

namespace App\Http\Controllers\Web\Penjualan;

use Illuminate\Http\Request;
use App\Models\SettingAplikasi;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Http;

class ExpedisiController extends Controller
{
    function getRates(Request $request)
    {

        $pelanggan = $request->pelanggan;
        $alamat = $request->alamat;
        $item = $request->item;

        
        if ($alamat == null) {
            return $this->sendError('Silahkan isi Data Alamat terlebih dahulu');
        }

        if ($item == null) {
            return $this->sendError('Silahkan isi Data Kerangjang terlebih dahulu');
        }

        if ($pelanggan == null) {
            return $this->sendError('Silahkan isi Data Pelanggan terlebih dahulu');
        }
        $kurir = SettingAplikasi::where('key', 'couriers')->first();
        $url = SettingAplikasi::where('key', 'url_biteship')->first();
        $token = SettingAplikasi::where('key', 'token_biteship')->first();
        $headers = [
            'authorization' => $token->value,
            'content-type' => 'application/json'
        ];
        
        try {
            $response = Http::withHeaders($headers)->post($url->value . '/v1/rates/couriers', [
                "origin_postal_code" => $alamat['kode_pos'],
                "destination_latitude" => $alamat['region']['latitude'],
                "destination_longitude" => $alamat['region']['longitude'],
                "couriers" => $kurir->value,
                "items" => []
            ]);
            $data = $response->json();
            if ($data['success'] == false) {
                return $this->sendError($data['error'] );
            }
            return $this->sendResponse($data['pricing'], 'success');
           
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }


        // $this->sendResponse();
    }
}
