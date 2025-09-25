<?php

namespace App\Http\Controllers;

use App\Models\GrupoEconomico;
use Illuminate\Http\Request;
use App\Services\GrupoEconomicoService;

class GrupoEconomicoController extends Controller
{
    protected $grupoService;

    public function __construct(GrupoEconomicoService $grupoService)
    {
        $this->grupoService = $grupoService;
    }

    public function index()
    {
        $grupos = $this->grupoService->listGrupos(10);

        return view('grupo_economico.index', compact('grupos'));
    }

    public function create()
    {
        return view('grupo_economico.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255', 'unique:grupos_economicos,nome'],
        ], [
            'nome.required' => 'O nome do grupo é obrigatório.',
            'nome.string'   => 'O nome deve ser um texto válido.',
            'nome.max'      => 'O nome não pode ter mais que 255 caracteres.',
            'nome.unique'   => 'Já existe um grupo com esse nome.',
        ]);

        $this->grupoService->createGrupo($validated);

        return redirect()
            ->route('grupo-economico.index')
            ->with('success', 'Grupo criado com sucesso!');
    }

    public function edit(GrupoEconomico $grupoEconomico)
    {
        return view('grupo_economico.edit', compact('grupoEconomico'));
    }

    public function update(Request $request, GrupoEconomico $grupoEconomico)
    {
        $validated = $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                'unique:grupos_economicos,nome,'.$grupoEconomico->id,
            ],
        ], [
            'nome.required' => 'O nome do grupo é obrigatório.',
            'nome.string'   => 'O nome deve ser um texto válido.',
            'nome.max'      => 'O nome não pode ter mais que 255 caracteres.',
            'nome.unique'   => 'Já existe um grupo com esse nome.',
        ]);

        $this->grupoService->updateGrupo($grupoEconomico, $validated);

        return redirect()
            ->route('grupo-economico.index')
            ->with('success', 'Grupo atualizado com sucesso!');
    }

    public function destroy(GrupoEconomico $grupoEconomico)
    {
        $this->grupoService->deleteGrupo($grupoEconomico);

        return redirect()
            ->route('grupo-economico.index')
            ->with('success', 'Grupo deletado com sucesso!');
    }
}
