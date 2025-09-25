@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Colaboradores</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('colaboradores.create') }}" class="btn btn-warning" wire:ignore.self>Criar Colaborador</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Unidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($colaboradores as $colaborador)
                    <tr>
                        <td>{{ $colaborador->nome }}</td>
                        <td>{{ $colaborador->email }}</td>
                        <td>{{ $colaborador->cpf }}</td>
                        <td>{{ $colaborador->unidade->nome_fantasia }}</td>
                        <td>
                            <a href="{{ route('colaboradores.edit', $colaborador) }}" class="btn btn-sm btn-light"
                                wire:ignore.self>Editar</a>
                            <form action="{{ route('colaboradores.destroy', $colaborador) }}" method="POST"
                                class="d-inline-block"
                                onsubmit="return confirm('Tem certeza que deseja deletar este colaborador?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-secondary">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhum colaborador encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $colaboradores->links() }}
    </div>
@endsection
