<?php

namespace App\Http\Controllers\Web\Master;

use Exception;
use App\Models\Wilayah;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables(Pelanggan::query())
                ->addIndexColumn()
                ->make(true);
        }

        return view('web.master.pelanggan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.master.pelanggan.formCreatePelanggan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePelangganRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelangganRequest $request)
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
                'nomor_telepon' => $data['nomor_telepone'],
                'nama_prov' => $wilayah->nama_prov,
                'nama_kab' => $wilayah->nama_kab,
                'nama_kec' => $wilayah->nama_kec,
                'kode_kec' => $wilayah->kode_kec,
                'kode_pos' => $data['kode_pos'],
                'alamat' => $data['alamat'],
                'lainnya' => $data['lainnya'],
                'region' => ['latitude' => $data['latitude'], 'longitude' => $data['longitude']],
            ];

            Pelanggan::create($create);
            return redirect()->route('pelanggan.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->route('pelanggan.create')->with('error', 'Error : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('web.master.pelanggan.formUpdatePelanggan', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePelangganRequest  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
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
                'nomor_telepon' => $data['nomor_telepon'],
                'nama_prov' => $wilayah->nama_prov,
                'nama_kab' => $wilayah->nama_kab,
                'nama_kec' => $wilayah->nama_kec,
                'kode_kec' => $wilayah->kode_kec,
                'kode_pos' => $data['kode_pos'],
                'alamat' => $data['alamat'],
                'lainnya' => $data['lainnya'],
                'region' => ['latitude' => $data['latitude'], 'longitude' => $data['longitude']],
            ];

            $pelanggan->update($update);
            return redirect()->route('pelanggan.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->route('pelanggan.index')->with('error', 'Error : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        //
    }
}
