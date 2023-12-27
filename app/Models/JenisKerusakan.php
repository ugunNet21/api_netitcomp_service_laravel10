<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKerusakan extends Model
{
    use HasFactory;
    protected $fillable = ['nama_jenis_kerusakan', 'deskripsi'];
    public function pemesanan()
    {
        return $this->belongsToMany(Pemesanan::class, 'pemesanan_jenis_kerusakans');
    }
}
