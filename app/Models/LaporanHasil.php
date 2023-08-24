<?php

namespace App\Models;

use App\Models\Skim;
use App\Models\Bidang;
use App\Models\Proposals;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LaporanHasil extends Model
{
    use HasFactory;
    // use LogsActivity;
    // protected $guarded = ['id'];
    // protected $primary = ['id'];
    protected $fillable =
    [
        'id',
        'judul_pkm',
        'id_bidang',
        'id_skim',
        'lok_kegiatan',
        'thn_mulai',
        'thn_selesai',
        // 'thn_pelaksanaan',
        'dana_dikti',
        'dana_unla',
        'dana_lainnya',
        'nosk_pkm',
        'tglsk_pkm',
        'mitra_pkm',
        'dok_laphasil'
    ];

    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logUnguarded()->useLogName('tLaporanHasils')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }

    public function proposal(): HasOne
    {
        return $this->hasOne(Proposals::class);
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }
    public function skim()
    {
        return $this->belongsTo(Skim::class, 'id_skim');
    }
}
