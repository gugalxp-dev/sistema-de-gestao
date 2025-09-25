<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unidade;
use App\Services\UnidadeService;

class UnidadeController extends Controller
{
    protected $unidadeService;

    public function __construct(UnidadeService $unidadeService)
    {
        $this->unidadeService = $unidadeService;
    }

    public function index()
    {
        $unidades = $this->unidadeService->listUnidades(10);

        return view('unidades.index', compact('unidades'));
    }

    public function create()
    {
        $bandeiras = $this->unidadeService->getBandeiras();

        return view('unidades.create', compact('bandeiras'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_fantasia' => ['required', 'string', 'max:255'],
            'razao_social'  => ['required', 'string', 'max:255'],
            'cnpj'          => ['required', 'string', 'size:14', 'unique:unidades,cnpj'],
            'bandeira_id'   => ['required', 'exists:bandeiras,id'],
        ], [
            'nome_fantasia.required' => 'O nome fantasia é obrigatório.',
            'nome_fantasia.max'      => 'O nome fantasia não pode ter mais que 255 caracteres.',

            'razao_social.required'  => 'A razão social é obrigatória.',
            'razao_social.max'       => 'A razão social não pode ter mais que 255 caracteres.',

            'cnpj.required'          => 'O CNPJ é obrigatório.',
            'cnpj.size'              => 'O CNPJ deve ter 14 dígitos (somente números).',
            'cnpj.unique'            => 'Já existe uma unidade com esse CNPJ.',

            'bandeira_id.required'   => 'Selecione uma bandeira.',
            'bandeira_id.exists'     => 'A bandeira selecionada não existe.',
        ]);

        $this->unidadeService->createUnidade($validated);

        return redirect()
            ->route('unidades.index')
            ->with('success', 'Unidade criada com sucesso!');
    }

    public function edit(Unidade $unidade)
    {
        $bandeiras = $this->unidadeService->getBandeiras();

        return view('unidades.edit', compact('unidade', 'bandeiras'));
    }

    public function update(Request $request, Unidade $unidade)
    {
        $validated = $request->validate([
            'nome_fantasia' => ['required', 'string', 'max:255'],
            'razao_social'  => ['required', 'string', 'max:255'],
            'cnpj' => [
                'required',
                'string',
                'size:14',
                'unique:unidades,cnpj,' . $unidade->id,
            ],
            'bandeira_id'   => ['required', 'exists:bandeiras,id'],
        ], [
            'nome_fantasia.required' => 'O nome fantasia é obrigatório.',
            'nome_fantasia.max'      => 'O nome fantasia não pode ter mais que 255 caracteres.',

            'razao_social.required'  => 'A razão social é obrigatória.',
            'razao_social.max'       => 'A razão social não pode ter mais que 255 caracteres.',

            'cnpj.required'          => 'O CNPJ é obrigatório.',
            'cnpj.size'              => 'O CNPJ deve ter 14 dígitos (somente números).',
            'cnpj.unique'            => 'Já existe uma unidade com esse CNPJ.',

            'bandeira_id.required'   => 'Selecione uma bandeira.',
            'bandeira_id.exists'     => 'A bandeira selecionada não existe.',
        ]);

        $this->unidadeService->updateUnidade($unidade, $validated);

        return redirect()
            ->route('unidades.index')
            ->with('success', 'Unidade atualizada com sucesso!');
    }

    public function destroy(Unidade $unidade)
    {
        $this->unidadeService->deleteUnidade($unidade);

        return redirect()
            ->route('unidades.index')
            ->with('success', 'Unidade deletada com sucesso!');
    }
}
