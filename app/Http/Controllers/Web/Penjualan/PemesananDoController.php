<?php

namespace App\Http\Controllers\Web\Penjualan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storepemesanan_doRequest;
use App\Http\Requests\Updatepemesanan_doRequest;
use App\Models\PemesananDo;

class PemesananDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables(PemesananDo::id_pembuat())
                ->addIndexColumn()
                
                ->make(true);
        }

        return view('web.penjualan.pemesanan_do.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('web.penjualan.pemesanan_do.formCreateDo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storepemesanan_doRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepemesanan_doRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemesanan_do  $pemesanan_do
     * @return \Illuminate\Http\Response
     */
    public function show(pemesanan_do $pemesanan_do)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemesanan_do  $pemesanan_do
     * @return \Illuminate\Http\Response
     */
    public function edit(pemesanan_do $pemesanan_do)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepemesanan_doRequest  $request
     * @param  \App\Models\pemesanan_do  $pemesanan_do
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepemesanan_doRequest $request, pemesanan_do $pemesanan_do)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemesanan_do  $pemesanan_do
     * @return \Illuminate\Http\Response
     */
    public function destroy(pemesanan_do $pemesanan_do)
    {
        //
    }
}
