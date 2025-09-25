@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Novo Grupo Econômico</h1>

    <form action="{{ route('grupo-economico.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome') }}">
            @error('nome')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="{{ route('grupo-economico.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
