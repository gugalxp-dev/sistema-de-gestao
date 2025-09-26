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
                'file_name' => $fileName,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function download(string $fileName)
    {
        $filePath = storage_path("app/public/exports/{$fileName}.xlsx");

        if (!file_exists($filePath)) {
            abort(404, 'Arquivo não encontrado.');
        }

        return response()->download($filePath);
    }

}
