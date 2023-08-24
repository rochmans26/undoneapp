<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skim extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_skim';
    protected $fillable = ['nm_skim', 'slug'];
    // use LogsActivity;
    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logFillable()->useLogName('tSkim')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }

    public function proposal()
    {
        return $this->hasMany(Proposals::class);
    }

    public function laporanhasil()
    {
        return $this->hasMany(LaporanHasil::class, 'id_skim');
    }
}
