<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        try {
            $notifikasi = Notifikasi::all();

            if ($notifikasi->count() > 0) {
                $formattedNotifikasi = $notifikasi->map(function ($item) {
                    return $this->formatNotifikasi($item);
                });

                return response()->json([
                    'status' => true,
                    'message' => "Data Available",
                    'data' => $formattedNotifikasi,
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Data Not Available",
                    'data' => null,
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function formatNotifikasi($notifikasi)
    {
        return [
            'id' => $notifikasi->id,
            'judul' => $notifikasi->judul,
            'isi_pesan' => $notifikasi->isi_pesan,
            'tanggal_dikirim' => Carbon::parse($notifikasi->tanggal_dikirim)->format('Y-m-d H:i:s'),
            'pemesanan_id' => $notifikasi->pemesanan_id,
            'created_at' => Carbon::parse($notifikasi->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($notifikasi->updated_at)->format('Y-m-d H:i:s'),
        ];
    }

    public function show($id)
    {
        try {
            $notifikasi = Notifikasi::findOrFail($id);
            $formattedNotifikasi = $this->formatNotifikasi($notifikasi);

            return response()->json([
                'status' => true,
                'message' => 'Data Available',
                'data' => $formattedNotifikasi,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Data Not Found',
                'data' => null,
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'error' => $e->getMessage(),
            ]);
        }
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
        // Memformat tanggal dan waktu
        $formattedNotifikasi = $this->formatNotifikasi($notifikasi);

        return response()->json([
            'status' => true,
            'message' => 'Data Created Successfully',
            'data' => $formattedNotifikasi,
        ], 201);
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

        $formattedNotifikasi = $this->formatNotifikasi($notifikasi);

        return response()->json([
            'status' => true,
            'message' => 'Data Updated Successfully',
            'data' => $formattedNotifikasi,
        ], 200);
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data Deleted Successfully',
        ], 204);
    }
}
