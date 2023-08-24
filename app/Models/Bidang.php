<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bidang extends Model
{
    use HasFactory;
    // use LogsActivity;
    // protected $guarded = ['id_bidang'];
    protected $primaryKey = 'id_bidang';
    protected $fillable = ['nm_bidang', 'slug'];

    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logFillable()->useLogName('tBidang')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }

    public function proposal()
    {
        return $this->hasMany(Proposals::class, 'foreign_key', 'id_bidang');
    }

    public function laporanhasil()
    {
        return $this->hasMany(LaporanHasil::class, 'id_bidang');
    }
}
