<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Colaborador extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'colaboradores';

    protected $fillable = [
        'nome',
        'email',
        'cpf',
        'unidade_id',
    ];

    public function unidade()
    {
        return $this->belongsTo(Unidade::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nome', 'email', 'cpf', 'unidade_id'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}
