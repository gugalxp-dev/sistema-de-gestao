<?php

namespace App\Services;

use App\Models\Bandeira;
use App\Models\GrupoEconomico;
use Illuminate\Support\Facades\Log;
use Exception;

class BandeiraService
{
    public function listBandeiras($perPage = 10)
    {
        try {
            return Bandeira::with('grupoEconomico')
                ->orderBy('id', 'asc')
                ->paginate($perPage);
        } catch (Exception $e) {
            Log::error('Erro ao listar bandeiras: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível listar as bandeiras.');
        }
    }

    public function getGrupos()
    {
        try {
            return GrupoEconomico::all();
        } catch (Exception $e) {
            Log::error('Erro ao buscar grupos econômicos: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível carregar os grupos econômicos.');
        }
    }

    public function createBandeira(array $data): Bandeira
    {
        try {
            return Bandeira::create($data);
        } catch (Exception $e) {
            Log::error('Erro ao criar bandeira: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível criar a bandeira.');
        }
    }

    public function updateBandeira(Bandeira $bandeira, array $data): Bandeira
    {
        try {
            $bandeira->update($data);
            return $bandeira;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar bandeira: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível atualizar a bandeira.');
        }
    }

    public function deleteBandeira(Bandeira $bandeira): void
    {
        try {
            $bandeira->delete();
        } catch (Exception $e) {
            Log::error('Erro ao deletar bandeira: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível deletar a bandeira.');
        }
    }
}
