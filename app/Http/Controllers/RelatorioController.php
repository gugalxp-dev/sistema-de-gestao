<?php

namespace App\Http\Controllers;

use App\Services\RelatorioService;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    protected $relatorioService;

    public function __construct(RelatorioService $relatorioService)
    {
        $this->relatorioService = $relatorioService;
    }

    public function index(Request $request)
    {
        $filtros = $this->relatorioService->getFiltros();

        $colaboradores = $this->relatorioService->filtrarColaboradores($request)->paginate(10);

        return view('relatorios.colaboradores', [
            'colaboradores' => $colaboradores,
            'grupos' => $filtros['grupos'],
            'bandeiras' => $filtros['bandeiras'],
            'unidades' => $filtros['unidades'],
        ]);
    }

    public function export(Request $request)
    {
        try {
            $fileName = $this->relatorioService->exportarColaboradores($request);

            return response()->json([
                'message' => 'Exportação iniciada',
                'download_url' => asset("storage/exports/{$fileName}.xlsx"),
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
