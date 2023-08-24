<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publikasi extends Model
{
    use HasFactory;
    // use LogsActivity;
    // protected $guarded = ['id_publikasi'];
    protected $primaryKey = 'id_publikasi';
    protected $fillable = [
        'id_laphasil',
        'judul_jurnal',
        'nm_jurnal' ,
        'vol_jurnal',
        'no_jurnal',
        'tgl_terbit_jurnal',
        'jumlah_penulis',
        'dok_jurnal',
        'link_jurnal',
        'status_jurnal'
    ];
    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logFillable()->useLogName('tPublikasi')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }
}
