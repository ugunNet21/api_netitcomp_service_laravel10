<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'isi_pesan', 'tanggal_dikirim', 'pemesanan_id'];
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
