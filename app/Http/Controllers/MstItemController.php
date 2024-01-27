<?php

namespace App\Http\Controllers;

use App\Models\MstItem;
use Illuminate\Http\Request;

class MstItemController extends Controller
{
    //
    public function inputItem(Request $request)
    {
        try {
            $data = MstItem::create([
                'kode' => $request->kode,
                'nama_item' => $request->nama_item,
                'harga' => $request->harga,
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
}
