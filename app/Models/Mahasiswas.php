<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswas extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];

    public function mahasiswa()
    {
        return $this->hasMany(AnggotaMahasiswa::class, 'id');
    }
    public function prodi(){
        return $this->belongsTo(Prodi::class, 'id');
    }
}
