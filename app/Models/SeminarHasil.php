<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarHasil extends Model
{
    use HasFactory;
    // use LogsActivity;
    // protected $guarded = ['id_semhas'];

    protected $primaryKey = 'id_semhas';
    protected $fillable = [
        'id_laphasil',
        'tgl_semhas',
        'jam_semhas',
        'sifat_semhas',
        'tmpt_semhas',
        'tautan_semhas',
        'rev1_semhas',
        'rev2_semhas',
        'nrev1_semhas',
        'nrev2_semhas',
        'dok_rev_semhas'
    ];
    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logFillable()->useLogName('tSeminarHasil')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }
}
