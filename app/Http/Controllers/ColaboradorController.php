<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use App\Services\ColaboradorService;
use Exception;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    protected $colaboradorService;

    public function __construct(ColaboradorService $colaboradorService)
    {
        $this->colaboradorService = $colaboradorService;
    }

    public function index()
    {
        $colaboradores = $this->colaboradorService->listColaboradores();

        return view('colaboradores.index', compact('colaboradores'));
    }

    public function create()
    {
        $unidades = $this->colaboradorService->getUnidades();

        return view('colaboradores.create', compact('unidades'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:colaboradores,email'],
            'cpf' => ['required', 'string', 'size:11', 'unique:colaboradores,cpf'],
            'unidade_id' => ['required', 'exists:unidades,id'],
        ]);

        try {
            $this->colaboradorService->createColaborador($validated);

            return redirect()
                ->route('colaboradores.index')
                ->with('success', 'Colaborador criado com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit(Colaborador $colaborador)
    {
        $unidades = $this->colaboradorService->getUnidades();

        return view('colaboradores.edit', compact('colaborador', 'unidades'));
    }

    public function update(Request $request, Colaborador $colaborador)
    {
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:colaboradores,email,'.$colaborador->id],
            'cpf' => ['required', 'string', 'size:11', 'unique:colaboradores,cpf,'.$colaborador->id],
            'unidade_id' => ['required', 'exists:unidades,id'],
        ]);

        try {
            $this->colaboradorService->updateColaborador($colaborador, $validated);

            return redirect()
                ->route('colaboradores.index')
                ->with('success', 'Colaborador atualizado com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Colaborador $colaborador)
    {
        try {
            $this->colaboradorService->deleteColaborador($colaborador);

            return redirect()
                ->route('colaboradores.index')
                ->with('success', 'Colaborador deletado com sucesso!');
        } catch (Exception $e) {
            return redirect()
                ->back()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }
}
