@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Bandeiras</h1>
        <a href="{{ route('bandeira.create') }}" class="btn btn-warning mb-3" wire:ignore.self>Nova Bandeira</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Grupo Econômico</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bandeiras as $bandeira)
                    <tr>
                        <td>{{ $bandeira->nome }}</td>
                        <td>{{ $bandeira->grupoEconomico->nome }}</td>
                        <td>
                            <a href="{{ route('bandeira.edit', $bandeira->id) }}" class="btn btn-sm btn-light"
                                wire:ignore.self>Editar</a>

                            <form action="{{ route('bandeira.destroy', $bandeira->id) }}" method="POST"
                                style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-secondary"
                                    onclick="return confirm('Deseja realmente deletar?')">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Nenhuma bandeira encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $bandeiras->links() }}
    </div>
@endsection
