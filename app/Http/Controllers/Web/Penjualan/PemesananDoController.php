<?php

namespace App\Http\Controllers\Web\Penjualan;

use App\Models\PemesananDo;
use Illuminate\Http\Request;
use App\Models\DetailPemesananDo;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storepemesanan_doRequest;
use App\Http\Requests\Updatepemesanan_doRequest;
use Exception;

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
            return datatables(PemesananDo::IdPembuat()
            ->with(['alamat', 'pelanggan'])
            ->orderBy('id', 'desc'))
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
    public function store(Request $request, $ajukan = false)
    {
        // simpan semua data ke draft
        $pelanggan = $request->pelanggan;
        $alamat = $request->alamat;
        $items = Collect($request->item);
        $kurir = $request->kurir;
        $user = auth()->user();

        if ($pelanggan == null && $alamat == null && count($items) == 0 && $kurir == null) {
            return $this->sendError('belum ada data yang terisi');
        }

        try {
            DB::beginTransaction();

            $data_pemesanan = [
                'nama_pengirim' => $alamat['nama'] ?? null,
                'koordinat_pengirim' => $alamat['region'] ?? null,
                'kode_pos_pengirim' => $alamat['kode_pos'] ?? null,
                'nama_penerima' => $pelanggan['kode_pos'] ?? null,
                'alamat_penerima' => $pelanggan['alamat'] ?? null,
                'kode_pos_penerima' => $pelanggan['kode_pos'] ?? null,
                'koordinat_penerima' => $pelanggan['region'] ?? null,
                'harga_total' => $items->pluck('total_harga')->sum() ?? null,
                'ongkos_kirim' => $kurir['price'] ?? null,
                'ekspedisi' => $kurir['courier_name'] ?? null,
                'tipe' => $kurir['courier_service_name'] ?? null,
                'detail_kurir' => $kurir ?? null,
                'status' => 'draft',
                'kirim' => 'pending',
                'id_pembuat' => $user->id,
                'id_pelanggan' => $pelanggan['id'] ?? null,
                'id_alamat' => $alamat['id'] ?? null,
            ];

            $do =  PemesananDo::create($data_pemesanan);

            // data item 

            foreach ($items as $key => $value) {
                $item = [
                    'id_pemesanan_do' =>  $do->id,
                    'id_produk' => $value['id'],
                    'nama_produk' => $value['nama'],
                    'sku' => $value['sku'],
                    'deskripsi_produk' => $value['deskripsi'],
                    'harga_produk' => $value['harga_non_format'],
                    'berat_produk' => $value['berat'],
                    'ukuran' => $value['ukuran'] ?? null,
                    'jumlah' => $value['jumlah'],
                ];

                DetailPemesananDo::create($item);
            }
            DB::commit();

            if ($request->ajukan) {
                return $do;
            }
            return $this->sendResponse($do, 'success');
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError($e->getMessage());
        }


        // simpan draft ke 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pemesanan_do  $pemesanan_do
     * @return \Illuminate\Http\Response
     */
    public function show(PemesananDo $pemesanan_do)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pemesanan_do  $pemesanan_do
     * @return \Illuminate\Http\Response
     */
    public function edit(PemesananDo $pemesanan_do,  $id)
    {
        $pemesanan = $pemesanan_do->where('id', $id)->with(['detail.produk', 'pelanggan'])->first();
        $items =  $pemesanan->detail->map(function ($item) {
            $produk = [...$item->toArray(), ...$item->produk->toArray()];
            $produk['harga_non_format'] = $item->harga_produk;
            $produk['total_harga'] = $item->harga_produk * $item->jumlah;
            return $produk;
        });

        $alamat = $pemesanan->alamat;
        $pelanggan = $pemesanan->pelanggan;
        $kurir = $pemesanan->detail_kurir;


        return view('web.penjualan.pemesanan_do.formUpdate', compact('items', 'alamat', 'pelanggan', 'kurir', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepemesanan_doRequest  $request
     * @param  \App\Models\pemesanan_do  $pemesanan_do
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $pelanggan = $request->pelanggan;
        $alamat = $request->alamat;
        $items = Collect($request->item);
        $kurir = $request->kurir;
        $user = auth()->user();

        if ($pelanggan == null && $alamat == null && count($items) == 0 && $kurir == null) {
            return $this->sendError('belum ada data yang terisi');
        }

        try {
            DB::beginTransaction();

            $data_pemesanan = [
                'nama_pengirim' => $alamat['nama'] ?? null,
                'koordinat_pengirim' => $alamat['region'] ?? null,
                'kode_pos_pengirim' => $alamat['kode_pos'] ?? null,
                'nama_penerima' => $pelanggan['kode_pos'] ?? null,
                'alamat_penerima' => $pelanggan['alamat'] ?? null,
                'kode_pos_penerima' => $pelanggan['kode_pos'] ?? null,
                'koordinat_penerima' => $pelanggan['region'] ?? null,
                'harga_total' => $items->pluck('total_harga')->sum() ?? null,
                'ongkos_kirim' => $kurir['price'] ?? null,
                'ekspedisi' => $kurir['courier_name'] ?? null,
                'tipe' => $kurir['courier_service_name'] ?? null,
                'detail_kurir' => $kurir ?? null,
                'status' => 'draft',
                'kirim' => 'pending',
                'id_pembuat' => $user->id,
                'id_pelanggan' => $pelanggan['id'] ?? null,
                'id_alamat' => $alamat['id'] ?? null,
            ];

            $do =  PemesananDo::where('id', $id)->update($data_pemesanan);

            // data item 
            // hapus terlebih dahulu detail barang
            DetailPemesananDo::where('id_pemesanan_do', $id)->delete();
            foreach ($items as  $value) {
                $item = [
                    'id_pemesanan_do' =>  $id,
                    'id_produk' => $value['id'],
                    'nama_produk' => $value['nama'],
                    'sku' => $value['sku'],
                    'deskripsi_produk' => $value['deskripsi'],
                    'harga_produk' => $value['harga_non_format'],
                    'berat_produk' => $value['berat'],
                    'ukuran' => $value['ukuran'] ?? null,
                    'jumlah' => $value['jumlah'],
                ];

                DetailPemesananDo::create($item);
            }
            DB::commit();

            if ($request->ajukan) {
                return $do;
            }
            return $this->sendResponse($do, 'success');
        } catch (Exception $e) {

            DB::rollBack();
            return $this->sendError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pemesanan_do  $pemesanan_do
     * @return \Illuminate\Http\Response
     */
    public function destroy(PemesananDo $pemesanan_do)
    {
        //
    }

    public function ajukan(Request $request)
    {
        $pelanggan = $request->pelanggan;
        $alamat = $request->alamat;
        $items = Collect($request->item);
        $kurir = $request->kurir;
        $request['ajukan'] = true;

        if ($items == null) {
            return $this->sendError('Keranjang masih kosong ');
        }

        if ($alamat == null) {
            return $this->sendError('Alamat belum ada yang dipilih');
        }

        if ($pelanggan == null) {
            return $this->sendError('Pelanggan belum ada yang dipilih');
        }

        if ($kurir == null) {
            return $this->sendError('Kurir belum ada yang dipilih');
        }

        if ((int)$request->id == 0) {

            try {
                $ajukan = $this->store($request);
                $id = $ajukan->id;
            } catch (Exception $e) {


                return $this->sendError($e->getMessage());
            }
        } else {
            $ajukan = $this->update($request, $request->id);
            $id = $request->id;
        }

        $this->update($request, (int)$request->id);
        PemesananDo::where('id', $id)->update(['status' => 'menunggu']);

        return $this->sendResponse([], 'success');
    }
}
