<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $fillable = ['deskripsi_kerusakan', 'status', 'tanggal_pesanan', 'kode_pesanan', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function jenisKerusakan()
    {
        return $this->belongsToMany(JenisKerusakan::class, 'pemesanan__jenis_kerusakans');
    }
}
