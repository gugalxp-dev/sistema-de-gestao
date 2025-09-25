<?php

namespace App\Http\Controllers;

use App\Models\Bandeira;
use Illuminate\Http\Request;
use App\Services\BandeiraService;

class BandeiraController extends Controller
{
    protected $service;

    public function __construct(BandeiraService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $bandeiras = $this->service->listBandeiras();

        return view('bandeira.index', compact('bandeiras'));
    }

    public function create()
    {
        $grupos = $this->service->getGrupos();

        return view('bandeira.create', compact('grupos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'grupo_economico_id' => ['required', 'exists:grupos_economicos,id'],
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres.',
            'grupo_economico_id.required' => 'Selecione um grupo econômico.',
            'grupo_economico_id.exists' => 'O grupo econômico selecionado não existe.',
        ]);

        $this->service->createBandeira($validated);

        return redirect()->route('bandeira.index')
            ->with('success', 'Bandeira criada com sucesso!');
    }

    public function edit(Bandeira $bandeira)
    {
        $grupos = $this->service->getGrupos();

        return view('bandeira.edit', compact('bandeira', 'grupos'));
    }

    public function update(Request $request, Bandeira $bandeira)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'grupo_economico_id' => ['required', 'exists:grupos_economicos,id'],
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais que 255 caracteres.',
            'grupo_economico_id.required' => 'Selecione um grupo econômico.',
            'grupo_economico_id.exists' => 'O grupo econômico selecionado não existe.',
        ]);

        $this->service->updateBandeira($bandeira, $validated);

        return redirect()->route('bandeira.index')
            ->with('success', 'Bandeira atualizada com sucesso!');
    }

    public function destroy(Bandeira $bandeira)
    {
        $this->service->deleteBandeira($bandeira);

        return redirect()->route('bandeira.index')
            ->with('success', 'Bandeira deletada com sucesso!');
    }
}
