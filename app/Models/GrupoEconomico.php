<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class GrupoEconomico extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'grupos_economicos';

    protected $fillable = [
        'nome',
    ];

    public function bandeiras()
    {
        return $this->hasMany(Bandeira::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nome'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
