<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan_JenisKerusakan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan_jenis_kerusakans';
    protected $fillable = ['pemesanan_id', 'jenis_kerusakan_id'];
}
