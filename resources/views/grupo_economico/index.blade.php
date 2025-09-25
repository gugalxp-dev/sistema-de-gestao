@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Grupos Econômicos</h1>
        <a href="{{ route('grupo-economico.create') }}" class="btn btn-warning mb-3" wire:ignore.self>Novo Grupo</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->nome }}</td>
                        <td>
                            <a href="{{ route('grupo-economico.edit', $grupo->id) }}" class="btn btn-sm btn-light"
                                wire:ignore.self>Editar</a>

                            <form action="{{ route('grupo-economico.destroy', $grupo->id) }}" method="POST"
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
                        <td colspan="3" class="text-center">Nenhum grupo encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $grupos->links() }}
    </div>
@endsection
