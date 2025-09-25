<?php

namespace App\Services;

use App\Jobs\ExportColaboradoresJob;
use App\Models\Bandeira;
use App\Models\Colaborador;
use App\Models\GrupoEconomico;
use App\Models\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Exception;

class RelatorioService
{
    public function getFiltros()
    {
        return [
            'grupos' => GrupoEconomico::all(),
            'bandeiras' => Bandeira::all(),
            'unidades' => Unidade::all(),
        ];
    }

    public function filtrarColaboradores(Request $request)
    {
        $colaboradores = Colaborador::with('unidade');

        if ($request->grupo_id) {
            $colaboradores->whereHas('unidade.bandeira.grupoEconomico', function ($q) use ($request) {
                $q->where('id', $request->grupo_id);
            });
        }

        if ($request->bandeira_id) {
            $colaboradores->whereHas('unidade.bandeira', function ($q) use ($request) {
                $q->where('id', $request->bandeira_id);
            });
        }

        if ($request->unidade_id) {
            $colaboradores->where('unidade_id', $request->unidade_id);
        }

        return $colaboradores;
    }

    public function exportarColaboradores(Request $request): string
    {
        $colaboradores = $this->filtrarColaboradores($request)->get();

        if ($colaboradores->isEmpty()) {
            throw new Exception('Nenhum colaborador encontrado para exportar.');
        }

        $fileName = 'colaboradores_'.now()->format('Ymd_His');

        ExportColaboradoresJob::dispatch($fileName, $colaboradores->pluck('id')->toArray());

        return $fileName;
    }
}
