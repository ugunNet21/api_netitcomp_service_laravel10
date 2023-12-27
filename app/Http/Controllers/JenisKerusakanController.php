<?php

namespace App\Http\Controllers;

use App\Models\JenisKerusakan;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Validator;

class JenisKerusakanController extends Controller
{
    public function index()
    {
        try {
            $jenisKerusakans = JenisKerusakan::all();
            return response()->json([
                'success' => true,
                'message' => 'Data jenis kerusakan berhasil diambil.',
                'data' => $jenisKerusakans,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data jenis kerusakan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jenis_kerusakan' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $jenisKerusakan = JenisKerusakan::create($request->all());
            return response()->json([
                'success' => true,
                'data' => $jenisKerusakan,
                'message' => 'Jenis kerusakan berhasil ditambahkan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan jenis kerusakan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
