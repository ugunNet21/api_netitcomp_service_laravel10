<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function harian()
    {
        $laporanHarian = Pemesanan::whereDate('created_at', now())->get();

        $formattedLaporanHarian = $laporanHarian->map(function ($laporan) {
            return [
                'id' => $laporan->id,
                'deskripsi_kerusakan' => $laporan->deskripsi_kerusakan,
                'status' => $laporan->status,
                'tanggal_pesanan' => Carbon::parse($laporan->tanggal_pesanan)->format('Y-m-d H:i:s'),
                'kode_pesanan' => $laporan->kode_pesanan,
                'user_id' => $laporan->user_id,
                'created_at' => Carbon::parse($laporan->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($laporan->updated_at)->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedLaporanHarian,
            'message' => 'Laporan harian berhasil diambil.',
        ]);
    }

    public function mingguan()
    {
        $laporanMingguan = Pemesanan::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->get();

        $formattedLaporanMingguan = $laporanMingguan->map(function ($laporan) {
            return [
                'id' => $laporan->id,
                'deskripsi_kerusakan' => $laporan->deskripsi_kerusakan,
                'status' => $laporan->status,
                'tanggal_pesanan' => Carbon::parse($laporan->tanggal_pesanan)->format('Y-m-d H:i:s'),
                'kode_pesanan' => $laporan->kode_pesanan,
                'user_id' => $laporan->user_id,
                'created_at' => Carbon::parse($laporan->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($laporan->updated_at)->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedLaporanMingguan,
            'message' => 'Laporan mingguan berhasil diambil.',
        ]);
    }

    public function bulanan()
    {
        $laporanBulanan = Pemesanan::whereMonth('created_at', now()->month)->get();

        $formattedLaporanBulanan = $laporanBulanan->map(function ($laporan) {
            return [
                'id' => $laporan->id,
                'deskripsi_kerusakan' => $laporan->deskripsi_kerusakan,
                'status' => $laporan->status,
                'tanggal_pesanan' => Carbon::parse($laporan->tanggal_pesanan)->format('Y-m-d H:i:s'),
                'kode_pesanan' => $laporan->kode_pesanan,
                'user_id' => $laporan->user_id,
                'created_at' => Carbon::parse($laporan->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($laporan->updated_at)->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $formattedLaporanBulanan,
            'message' => 'Laporan bulanan berhasil diambil.',
        ]);
    }

    public function tahunan()
    {
        $laporanTahunan = Pemesanan::whereYear('created_at', now()->year)->get();

        return response()->json([
            'success' => true,
            'data' => $laporanTahunan,
            'message' => 'Laporan tahunan berhasil diambil.',
        ]);
    }
}
