<?php

namespace App\Http\Controllers\Web\Pengaturan;

use Exception;
use Illuminate\Http\Request;
use App\Models\SettingAplikasi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PengaturanAplikasiController extends Controller
{
    function index()
    {
        $data = SettingAplikasi::utama()->get();
        return view('web.pengaturan.aplikasi.index', compact('data'));
    }

    function update(Request $request)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();

            foreach ($data as $key => $value) {
                SettingAplikasi::where('key', $key)->update(['value' => $value]);
            }
            DB::commit();
            return redirect()->route('pengaturanaplikasi')->with('success', 'Data berhasil diperbarui');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('pengaturanaplikasi')->with('error', 'Error : ' . $e->getMessage());
        }
    }
}
