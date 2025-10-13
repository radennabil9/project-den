<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';
    protected $fillable = ['tanggal', 'tim_id', 'realisasi_kwh'];

    // Relasi ke Tim
    public function tim()
    {
        return $this->belongsTo(Tim::class, 'tim_id');
    }
}
