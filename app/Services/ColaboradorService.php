<?php

namespace App\Services;

use App\Models\Colaborador;
use App\Models\Unidade;
use Illuminate\Support\Facades\Log;
use Exception;

class ColaboradorService
{
    public function listColaboradores($perPage = 10)
    {
        try {
            return Colaborador::with('unidade')->paginate($perPage);
        } catch (Exception $e) {
            Log::error('Erro ao listar colaboradores: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível listar os colaboradores.');
        }
    }

    public function getUnidades()
    {
        try {
            return Unidade::all();
        } catch (Exception $e) {
            Log::error('Erro ao buscar unidades: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível carregar as unidades.');
        }
    }

    public function createColaborador(array $data): Colaborador
    {
        try {
            return Colaborador::create($data);
        } catch (Exception $e) {
            Log::error('Erro ao criar colaborador: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível criar o colaborador.');
        }
    }

    public function updateColaborador(Colaborador $colaborador, array $data): Colaborador
    {
        try {
            $colaborador->update($data);
            return $colaborador;
        } catch (Exception $e) {
            Log::error('Erro ao atualizar colaborador: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível atualizar o colaborador.');
        }
    }

    public function deleteColaborador(Colaborador $colaborador): void
    {
        try {
            $colaborador->delete();
        } catch (Exception $e) {
            Log::error('Erro ao deletar colaborador: '.$e->getMessage(), ['exception' => $e]);
            throw new Exception('Não foi possível deletar o colaborador.');
        }
    }
}
