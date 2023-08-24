<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublikasiMandiri extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_pubman';
    protected $fillable = [
        'judul_jurnal_pubman',
        'nm_jurnal_pubman',
        'vol_jurnal_pubman',
        'no_jurnal_pubman',
        'tgl_terbit_jurnal_pubman',
        'jumlah_penulis_pubman',
        'dok_jurnal_pubman',
        'link_jurnal_pubman',
        'status_jurnal_pubman'
    ];
}
