<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        try {
            $notifikasi = Notifikasi::all();
            if ($notifikasi->count() > 0) {
                return response()->json([
                    'status' => true,
                    'message' => "Data Available",
                    'data' => $notifikasi,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Data Not Available",
                    'data' => null
                ], 404);
            }
            return response()->json($notifikasi);
        } catch (\Exception $e) {
            return response()->json([
                'satatus' => false,
                'erro' => $e->getMessage(),
            ]);
        }
    }

    public function show($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        return response()->json($notifikasi);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'isi_pesan' => 'required|string',
            'tanggal_dikirim' => 'required|date',
            'pemesanan_id' => 'required|exists:pemesanans,id',
        ]);

        $notifikasi = Notifikasi::create($request->all());
        return response()->json($notifikasi, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'string',
            'isi_pesan' => 'string',
            'tanggal_dikirim' => 'date',
            'pemesanan_id' => 'exists:pemesanans,id',
        ]);

        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->update($request->all());

        return response()->json($notifikasi, 200);
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return response()->json(null, 204);
    }
}
