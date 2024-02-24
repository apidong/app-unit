<?php

namespace App\Http\Controllers\Web\Master;

use App\Models\Alamat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAlamatRequest;
use App\Http\Requests\UpdateAlamatRequest;
use App\Models\Wilayah;
use Exception;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables(Alamat::query())
                ->addIndexColumn()
                ->make(true);
        }

        return view('web.master.alamat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.master.alamat.formCreateAlamat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlamatRequest $request)
    {
        $data = $request->validated();

        try {
            // get nama wilayah
            $wilayah = Wilayah::where([
                'kode_prov' => $data['nama_prov'],
                'kode_kab' => $data['nama_kab'],
                'kode_kec' => $data['nama_kec'],
            ])->first();

            $create = [
                'nama' => $data['nama'],
                'nama_prov' => $wilayah->nama_prov,
                'nama_kab' => $wilayah->nama_kab,
                'nama_kec' => $wilayah->nama_kec,
                'kode_pos' => $data['kode_pos'],
                'alamat' => $data['alamat'],
                'lainnya' => $data['lainnya'],
                'region' => ['latitude' => $data['latitude'], 'longitude' => $data['longitude']],
            ];

            Alamat::create($create);
            return redirect()->route('alamat.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->route('alamat.create')->with('error', 'Error : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function show(Alamat $alamat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function edit(Alamat $alamat)
    {
        return view('web.master.alamat.formUpdateAlamat', compact('alamat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlamatRequest $request, Alamat $alamat)
    {
        $data = $request->validated();

        try {
            $wilayah = Wilayah::where([
                'kode_prov' => $data['nama_prov'],
                'kode_kab' => $data['nama_kab'],
                'kode_kec' => $data['nama_kec'],
            ])->first();

            

            $update = [
                'nama' => $data['nama'],
                'nama_prov' => $wilayah->nama_prov,
                'nama_kab' => $wilayah->nama_kab,
                'nama_kec' => $wilayah->nama_kec,
                'kode_pos' => $data['kode_pos'],
                'alamat' => $data['alamat'],
                'lainnya' => $data['lainnya'],
                'region' => ['latitude' => $data['latitude'], 'longitude' => $data['longitude']],
            ];

            $alamat->update($update);
            return redirect()->route('alamat.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->route('alamat.index')->with('error', 'Error : ' . $e->getMessage());
        }
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alamat  $alamat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alamat $alamat)
    {
        //
    }
}
