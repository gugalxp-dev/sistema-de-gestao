<?php

namespace App\Services;

use App\Models\Unidade;
use App\Models\Bandeira;
use Illuminate\Support\Facades\Log;
use Exception;

class UnidadeService
{
    public function listUnidades($perPage = 10)
    {
        return Unidade::with('bandeira')->paginate($perPage);
    }

    public function getBandeiras()
    {
        return Bandeira::all();
    }

    public function createUnidade(array $data): Unidade
    {
        try {
            return Unidade::create($data);
        } catch (Exception $e) {
            Log::error("Erro ao criar unidade: " . $e->getMessage());
            throw $e;
        }
    }

    public function updateUnidade(Unidade $unidade, array $data): Unidade
    {
        try {
            $unidade->update($data);
            return $unidade;
        } catch (Exception $e) {
            Log::error("Erro ao atualizar unidade: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteUnidade(Unidade $unidade): void
    {
        try {
            $unidade->delete();
        } catch (Exception $e) {
            Log::error("Erro ao deletar unidade: " . $e->getMessage());
            throw $e;
        }
    }
}
