<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Karyawan;
use App\Models\MstItem;
use App\Models\TrxKoperasi;

class TrxKoperasiController extends Controller
{
    //
    public function index()
    {
        $npk = Karyawan::all();
        $now = Carbon::now()->format('Y-m-d');
        $mstItem = MstItem::all();
        // dd($npk);
        return view('index', compact(['npk', 'now', 'mstItem']));
    }

    public function viewTrx()
    {
        $rows = TrxKoperasi::get();
        $npk = Karyawan::all();
        $mstItem = MstItem::all();
        foreach ($rows as $row) {
            $lists[] = array(
                'id' => $row->id,
                'npk' => $row->npk,
                'nama' => Karyawan::where('npk', $row->npk)->first()->nama,
                'tanggal' => $row->tgl_transaksi,
                'kode' => $row->kode,
                'item' => MstItem::where('kode', $row->kode)->first()->nama_item,
                'qty' => $row->qty,
                'harga' => $row->harga,
                'total' => ($row->harga * $row->qty),
                'tipeBayar' => ($row->bayar == 1) ? 'Lunas' : 'Cicil'
            );
        }
        // dd($lists);


        return view('viewTrx', compact(['lists', 'npk', 'mstItem']));
    }

    public function store(Request $request)
    {
        $trx = new TrxKoperasi();
        $trx->npk = $request->input('npk');
        $trx->tgl_transaksi = $request->input('tgl_transaksi');
        $trx->kode = $request->input('kode');
        $trx->qty = $request->input('qty');
        $trx->harga = $request->input('harga');
        $trx->bayar = $request->input('bayar');
        $trx->save();

        session()->flash('success', 'Data berhasil disimpan!');

        return redirect()->back();
    }

    public function trx()
    {
        $rows = TrxKoperasi::get();
        foreach ($rows as $row) {
            $data[] = array(
                'id' => $row->id,
                'npk' => $row->npk,
                'nama' => $row->npk . " - " . Karyawan::where('npk', $row->npk)->first()->nama,
                'tanggal' => $row->tgl_transaksi,
                'kode' => $row->kode,
                'item' => $row->kode . " - " . MstItem::where('kode', $row->kode)->first()->nama_item,
                'qty' => $row->qty,
                'harga' => $row->harga,
                'total' => ($row->harga * $row->qty),
                'tipeBayar' => ($row->bayar == 1) ? 'Lunas' : 'Cicil'
            );
        }
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'berhasil!',
                'data' => $data
            ], 200);
        }
    }

    public function search(Request $request)
    {
        $tanggal = $request->input('tgl_transaksi', '');
        $npka = $request->input('npk', '');
        $tipeBayar = $request->input('bayar', '');

        $rows = TrxKoperasi::where('tgl_transaksi', $tanggal)->orWhere('npk', $npka)->orWhere('bayar', $tipeBayar)->get();
        $npk = Karyawan::all();
        foreach ($rows as $row) {
            $lists[] = array(
                'id' => (int)$row->id,
                'nama' => Karyawan::where('npk', $row->npk)->first()->nama,
                'tanggal' => $row->tgl_transaksi,
                'kode' => $row->kode,
                'item' => MstItem::where('kode', $row->kode)->first()->nama_item,
                'qty' => $row->qty,
                'harga' => $row->harga,
                'total' => ($row->harga * $row->qty),
                'tipeBayar' => ($row->bayar == 1) ? 'Lunas' : 'Cicil'
            );
        }
        return view('viewTrx', compact('lists', 'npk'));
    }

    public function edit(Request $request)
    {
        TrxKoperasi::where('id', $request->input('id'))->update([
            'qty' => $request->input('qty'),
            'bayar' => $request->input('bayar', 1)
        ]);
        // dd($trx);
        return redirect()->back()->with('success', 'Data berhasil diperbarui');
    }
    public function delete($id)
    {
        TrxKoperasi::where('id', $id)->delete();
        // dd($trx);
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
