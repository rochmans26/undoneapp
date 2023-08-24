<?php

namespace App\Models;

use App\Models\LaporanHasil;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposals extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    // use LogsActivity;
    // protected $incremental = false;
    // protected $fillable = [
    //     'id',
    //     'judul_proposal',
    //     'slug',
    //     'id_bidang',
    //     'id_skim',
    //     'lokasi_kegiatan',
    //     'thn_usulan',
    //     'thn_kegiatan',
    //     'thn_pelaksanaan',
    //     'dok_link'
    // ];

  
    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logFillable()->useLogName('tProposals')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }

    public function skim()
    {
        return $this->belongsTo(Skim::class, 'id_skim');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function seminarproposal()
    {
        return $this->belongsTo(SeminarProposals::class, 'id_proposal');
    }

    public function laporanhasil(): BelongsTo
    {
        return $this->belongsTo(LaporanHasil::class, 'id_proposal');
    }
    
}
