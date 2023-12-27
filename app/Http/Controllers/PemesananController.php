<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemesananController extends Controller
{
    public function index()
    {
        try {
            $pemesanans = Pemesanan::with('user', 'jenisKerusakan')->get();
            return response()->json([
                'success' => true,
                'message' => 'Data pemesanan berhasil diambil.',
                'data' => $pemesanans,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data pemesanan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi_kerusakan' => 'required|string',
            'status' => 'required|string',
            'tanggal_pesanan' => 'required|date',
            'kode_pesanan' => 'required|string|unique:pemesanans',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $pemesanan = Pemesanan::create($request->all());
            return response()->json([
                'success' => true,
                'data' => $pemesanan,
                'message' => 'Pemesanan berhasil ditambahkan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan pemesanan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
