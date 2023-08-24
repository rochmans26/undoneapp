<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosens extends Model
{
    use HasFactory;
    // use LogsActivity;

    protected $guarded = ['id'];

    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logUnguarded()->useLogName('tDosens')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'id_prodi');
    }

    public function anggotadosenlokal()
    {
        return $this->hasMany(AnggotaDosenLokal::class, 'id_dosen');
    }
}
