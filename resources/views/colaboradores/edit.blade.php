@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Colaborador</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('colaboradores.update', $colaborador->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $colaborador->nome) }}" >
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $colaborador->email) }}" >
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" id="cpf" class="form-control" value="{{ old('cpf', $colaborador->cpf) }}" >
        </div>

        <div class="mb-3">
            <label for="unidade_id" class="form-label">Unidade</label>
            <select name="unidade_id" id="unidade_id" class="form-select" >
                <option value="">Selecione</option>
                @foreach($unidades as $unidade)
                    <option value="{{ $unidade->id }}" {{ old('unidade_id', $colaborador->unidade_id) == $unidade->id ? 'selected' : '' }}>
                        {{ $unidade->nome_fantasia }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Colaborador</button>
        <a href="{{ route('colaboradores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
