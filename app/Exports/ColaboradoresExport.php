<?php

namespace App\Exports;

use App\Models\Colaborador;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ColaboradoresExport implements FromQuery, WithChunkReading, WithHeadings, WithMapping
{
    protected $colaboradorIds;

    public function __construct($colaboradorIds = null)
    {
        $this->colaboradorIds = $colaboradorIds;
    }

    public function query()
    {
        $query = Colaborador::query()
            ->leftJoin('unidades', 'colaboradores.unidade_id', '=', 'unidades.id')
            ->select(
                'colaboradores.id',
                'colaboradores.nome',
                'colaboradores.email',
                'colaboradores.cpf',
                'unidades.nome_fantasia',
                'colaboradores.created_at'
            );

        if ($this->colaboradorIds) {
            $query->whereIn('colaboradores.id', $this->colaboradorIds);
        }

        return $query;
    }

    public function map($colaborador): array
    {
        return [
            $colaborador->id,
            $colaborador->nome,
            $colaborador->email,
            $colaborador->cpf,
            $colaborador->nome_fantasia ?? '',
            Carbon::parse($colaborador->created_at)->format('d/m/Y H:i'),
        ];
    }

    public function headings(): array
    {
        return ['ID', 'Nome', 'Email', 'CPF', 'Unidade', 'Criado em'];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
