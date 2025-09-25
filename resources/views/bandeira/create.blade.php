@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nova Bandeira</h1>

    <form action="{{ route('bandeira.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}">
            @error('nome')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="grupo_economico_id" class="form-label">Grupo Econômico</label>
            <select name="grupo_economico_id" id="grupo_economico_id" class="form-select">
                <option value="">Selecione</option>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id }}" {{ old('grupo_economico_id') == $grupo->id ? 'selected' : '' }}>{{ $grupo->nome }}</option>
                @endforeach
            </select>
            @error('grupo_economico_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('bandeira.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
