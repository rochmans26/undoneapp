<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenLuar extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];

    public function anggotadosenluar()
    {
        return $this->hasMany(AnggotaDosenLuar::class, 'nidn_dosen_luar');
    }
}
