<?php

namespace App\Jobs;

use App\Exports\ColaboradoresExport;
use App\Models\Colaborador;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExportColaboradoresJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $fileName;

    public $colaboradorIds;

    public $timeout = 1200;

    public function __construct($fileName, $colaboradorIds)
    {
        $this->fileName = $fileName;
        $this->colaboradorIds = $colaboradorIds;
    }

    public function handle()
    {

        try {
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

            $allData = new Collection;

            $query->chunk(1000, function ($colaboradores) use (&$allData) {
                foreach ($colaboradores as $colaborador) {
                    $allData->push([
                        'id' => $colaborador->id,
                        'nome' => $colaborador->nome,
                        'email' => $colaborador->email,
                        'cpf' => $colaborador->cpf,
                        'unidade' => $colaborador->nome_fantasia ?? '',
                        'criado_em' => Carbon::parse($colaborador->created_at)->format('d/m/Y H:i'),
                    ]);
                }
            });

            Excel::store(new ColaboradoresExport($this->colaboradorIds), "public/exports/{$this->fileName}.xlsx");

        } catch (\Throwable $e) {
            Log::error('Falha na exportação MANUAL: '.$e->getMessage(), ['exception' => $e]);
            throw $e;
        }
    }
}
