<?php

namespace App\Models;

use App\Models\Dosens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnggotaDosenLokal extends Model
{
    // use LogsActivity;
    use HasFactory;
    protected $guarded = ['id'];

    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logUnguarded()->useLogName('tAnggotaDosen')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }

    public function dosen()
    {
        return $this->belongsTo(Dosens::class, 'id_dosen');
    }
}
