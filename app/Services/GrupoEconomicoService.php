<?php

namespace App\Services;

use App\Models\GrupoEconomico;
use Illuminate\Support\Facades\Log;

class GrupoEconomicoService
{
    public function listGrupos($perPage = 10)
    {
        try {
            return GrupoEconomico::orderBy('id', 'asc')->paginate($perPage);
        } catch (\Exception $e) {
            Log::error('Erro ao listar grupos econômicos: '.$e->getMessage());
            throw $e;
        }
    }

    public function createGrupo(array $data): GrupoEconomico
    {
        try {
            return GrupoEconomico::create($data);
        } catch (\Exception $e) {
            Log::error('Erro ao criar grupo econômico: '.$e->getMessage());
            throw $e;
        }
    }

    public function updateGrupo(GrupoEconomico $grupo, array $data): GrupoEconomico
    {
        try {
            $grupo->update($data);
            return $grupo;
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar grupo econômico: '.$e->getMessage());
            throw $e;
        }
    }

    public function deleteGrupo(GrupoEconomico $grupo): void
    {
        try {
            $grupo->delete();
        } catch (\Exception $e) {
            Log::error('Erro ao deletar grupo econômico: '.$e->getMessage());
            throw $e;
        }
    }
}
