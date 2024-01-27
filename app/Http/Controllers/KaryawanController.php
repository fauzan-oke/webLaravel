<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    //
    public function inputKaryawan(Request $request)
    {
        try {
            $data = Karyawan::create([
                'npk' => $request->npk,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
            ]);

            if ($data) {
                return response()->json([
                    'success' => true,
                    'message' => 'berhasil!',
                    'data' => $data
                ], 200);
            }
        } catch (\Throwable $e) {
            // report($e);
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function dropdownNPK()
    {
        $npk = Karyawan::all();
        dd($npk);

        return view('index', compact(['npk']));
    }

    public function karyawan()
    {
        $data = Karyawan::all();
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'berhasil!',
                'data' => $data
            ], 200);
        }
    }
}
