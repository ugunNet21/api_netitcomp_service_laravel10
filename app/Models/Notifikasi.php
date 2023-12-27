<?php

namespace App\Models;

use Carbon\Carbon;
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

    // public function setTanggalDikirimAttribute($value)
    // {
    //     $this->attributes['tanggal_dikirim'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    // }

    public function getTanggalDikirimAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
