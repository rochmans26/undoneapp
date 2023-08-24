<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prodi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // use LogsActivity;
    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logUnguarded()->useLogName('tProdi')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'id_fak');
    }

    public function dosen()
    {
        return $this->hasMany(Dosens::class, 'id');
    }
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswas::class, 'id');
    }
}
