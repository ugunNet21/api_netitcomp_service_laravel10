<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        try {
            $users = User::all();

            // Memformat tanggal dan waktu untuk setiap pengguna
            $formattedUsers = $this->formatUsers($users);

            return response()->json([
                'success' => true,
                'message' => 'Data pengguna berhasil diambil.',
                'data' => $formattedUsers,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data pengguna.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function formatUsers($users)
    {
        return $users->map(function ($user) {
            return [
                'id' => $user->id,
                'nama' => $user->nama,
                'nomor_telepon' => $user->nomor_telepon,
                'alamat' => $user->alamat,
                'email' => $user->email,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => Carbon::parse($user->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($user->updated_at)->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string',
            'nomor_telepon' => 'required|string',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $user = User::create($request->all());

            // Memformat tanggal dan waktu setelah pembuatan pengguna
            $formattedUser = $this->formatUser($user);

            return response()->json([
                'success' => true,
                'data' => $formattedUser,
                'message' => 'Pengguna berhasil ditambahkan.',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan pengguna.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
