<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserULP;
use App\Models\Transaksi;

class Tim extends Model
{
    use HasFactory;

    protected $table = 'tims';
    protected $fillable = ['nama_regu', 'anggota', 'user_ulp_id'];

    public function userULP()
    {
        return $this->belongsTo(UserULP::class, 'user_ulp_id');
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'tim_id');
    }

}
