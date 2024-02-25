<?php

namespace App\Http\Controllers\Web\Master;

use Exception;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables(Produk::query())
                ->addIndexColumn()
                ->addColumn('harga', function ($data) {
                    // Process data for the custom column before sending it
                    return 'Rp ' . rupiah($data->harga);
                })
                ->addColumn('harga_non_format', function ($data) {
                    return  $data->harga;
                })
                ->make(true);
        }

        return view('web.master.produk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('web.master.produk.formCreateProduk', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukRequest $request)
    {
        $data = $request->validated();

        try {
            $produk = [
                'nama' => $data['nama'],
                'sku' => $data['sku'],
                'deskripsi' => $data['deskripsi'],
                'id_kategori' => $data['kategori'],
                'harga' => unformat_rupiah($data['harga'] ?? 0),
                'berat' => unformat_rupiah($data['berat'] ?? 0),
                'ukuran' => collect($data['ukuran'])->map(fn ($ukuran)  =>  unformat_rupiah($ukuran)),
            ];
            Produk::create($produk);
            return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->route('produk.index')->with('error', 'Error : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        $kategori = Kategori::all();
        return view('web.master.produk.formUpdateProduk', compact('kategori', 'produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        $data = $request->validated();

        try {
            $update = [
                'nama' => $data['nama'],
                'sku' => $data['sku'],
                'deskripsi' => $data['deskripsi'],
                'id_kategori' => $data['kategori'],
                'harga' => unformat_rupiah($data['harga'] ?? 0),
                'berat' => unformat_rupiah($data['berat'] ?? 0),
                'ukuran' => collect($data['ukuran'])->map(fn ($ukuran)  =>  unformat_rupiah($ukuran)),
            ];
            $produk->update($update);
            return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
        } catch (Exception $e) {
            return redirect()->route('produk.index')->with('error', 'Error : ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }

    function cari(Request $request)
    {
        $cari = Str::of($request->search)->strip_tags();
        try {
            $results = Produk::where('nama', 'like', '%' . $cari . '%')
                ->orWhere('column_name', 'like', '%' . $cari . '%')->get();
            $this->sendResponse($results, 'success');
        } catch (Exception $e) {
            $this->sendError($e->getMessage());
        }
    }
}
