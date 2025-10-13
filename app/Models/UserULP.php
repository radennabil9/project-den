<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tim;

class UserULP extends Model
{
    use HasFactory;

    protected $table = 'user_u_l_p_s';

    protected $fillable = ['nama_ulp', 'username', 'password'];
    protected $hidden = ['password'];

    // Relasi ke Tim
    public function tims()
    {
        return $this->hasMany(Tim::class, 'user_ulp_id');
    }

   
}

