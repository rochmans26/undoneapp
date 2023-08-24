<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeminarProposals extends Model
{
    use HasFactory;
    // use LogsActivity;
    // protected $guarded = ['id_sempro'];
    protected $primaryKey = 'id_sempro';
    protected $fillable = [
        'id_proposal',
        'tgl_seminar',
        'jam_seminar',
        'sifat_seminar',
        'tmpt_seminar',
        'tautan',
        'reviewer1',
        'reviewer2',
        'note_rev1',
        'note_rev2',
        'dok_rev'
    ];
    // protected static $recordEvents = ['deleted', 'updated', 'created'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logFillable()->useLogName('tSeminarProposal')->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName} by" . Auth::user()->name)->logOnlyDirty();
    //     // Chain fluent methods for configuration options
    // }

    public function proposal()
    {
        return $this->hasOne(Proposals::class, 'id_proposal');
    }
}
