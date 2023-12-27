<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PencarianPemesananController extends Controller
{
    public function search(Request $request)
{
    $validator = Validator::make($request->all(), [
        'keyword' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validasi gagal.',
            'errors' => $validator->errors()
        ], 422);
    }

    try {
        $keyword = $request->input('keyword');

        $pemesanans = Pemesanan::with('user', 'jenisKerusakan')
            ->where(function ($query) use ($keyword) {
                $query->where('deskripsi_kerusakan', 'like', "%$keyword%")
                    ->orWhere('status', 'like', "%$keyword%")
                    ->orWhereHas('user', function ($query) use ($keyword) {
                        $query->where('nama', 'like', "%$keyword%");
                    })
                    ->orWhereHas('jenisKerusakan', function ($query) use ($keyword) {
                        $query->where('nama', 'like', "%$keyword%");
                    });
            })
            ->get();

        return response()->json([
            'success' => true,
            'data' => $pemesanans,
            'message' => 'Pencarian berhasil.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Gagal melakukan pencarian.',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
