@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Criar Unidade</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('unidades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
            <input type="text" name="nome_fantasia" id="nome_fantasia" class="form-control" value="{{ old('nome_fantasia') }}" >
        </div>

        <div class="mb-3">
            <label for="razao_social" class="form-label">Razão Social</label>
            <input type="text" name="razao_social" id="razao_social" class="form-control" value="{{ old('razao_social') }}" >
        </div>

        <div class="mb-3">
            <label for="cnpj" class="form-label">CNPJ</label>
            <input type="text" name="cnpj" id="cnpj" class="form-control" value="{{ old('cnpj') }}" >
        </div>

        <div class="mb-3">
            <label for="bandeira_id" class="form-label">Bandeira</label>
            <select name="bandeira_id" id="bandeira_id" class="form-select" >
                <option value="">Selecione</option>
                @foreach($bandeiras as $bandeira)
                    <option value="{{ $bandeira->id }}" {{ old('bandeira_id') == $bandeira->id ? 'selected' : '' }}>
                        {{ $bandeira->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Criar Unidade</button>
        <a href="{{ route('unidades.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
