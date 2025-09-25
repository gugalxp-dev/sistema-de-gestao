<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Bandeira extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'bandeiras';

    protected $fillable = ['nome', 'grupo_economico_id'];

    public function grupoEconomico()
    {
        return $this->belongsTo(GrupoEconomico::class);
    }

    public function unidades()
    {
        return $this->hasMany(Unidade::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nome', 'grupo_economico_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
