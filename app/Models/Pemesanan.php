<?php

namespace App\Models;

use Carbon\Carbon;
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
        return $this->belongsToMany(JenisKerusakan::class, 'pemesanan_jenis_kerusakans');
    }

    public function setTanggalPesananAttribute($value)
    {
        $this->attributes['tanggal_pesanan'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    // Definisikan mutator untuk updated_at
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
