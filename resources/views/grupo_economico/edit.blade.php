@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Grupo Econômico</h1>

    <form action="{{ route('grupo-economico.update', $grupoEconomico->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome', $grupoEconomico->nome) }}">
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Atualizar</button>
        <a href="{{ route('grupo-economico.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
