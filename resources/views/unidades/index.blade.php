@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Unidades</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{ route('unidades.create') }}" class="btn btn-warning" wire:ignore.self>Criar Unidade</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nome Fantasia</th>
                <th>Razão Social</th>
                <th>CNPJ</th>
                <th>Bandeira</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($unidades as $unidade)
                <tr>
                    <td>{{ $unidade->nome_fantasia }}</td>
                    <td>{{ $unidade->razao_social }}</td>
                    <td>{{ $unidade->cnpj }}</td>
                    <td>{{ $unidade->bandeira->nome }}</td>
                    <td>
                        <a href="{{ route('unidades.edit', $unidade) }}" class="btn btn-sm btn-light" wire:ignore.self>Editar</a>

                        <form action="{{ route('unidades.destroy', $unidade) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Tem certeza que deseja deletar esta unidade?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-secondary">Deletar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhuma unidade encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $unidades->links() }}
</div>
@endsection
