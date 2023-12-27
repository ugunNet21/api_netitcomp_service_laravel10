<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan_JenisKerusakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemesananJenisKerusakanController extends Controller
{
    public function index()
    {
        try {
            $pemesananJenisKerusakans = Pemesanan_JenisKerusakan::all();
            return response()->json([
                'success' => true,
                'message' => 'Data pemesanan jenis kerusakan berhasil diambil.',
                'data' => $pemesananJenisKerusakans,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data pemesanan jenis kerusakan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'jenis_kerusakan_id' => 'required|exists:jenis_kerusakans,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $pemesananJenisKerusakan = Pemesanan_JenisKerusakan::create($request->all());
            return response()->json([
                'success' => true,
                'data' => $pemesananJenisKerusakan,
                'message' => 'Pemesanan jenis kerusakan berhasil ditambahkan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan pemesanan jenis kerusakan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
