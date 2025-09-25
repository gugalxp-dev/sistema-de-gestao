@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Perfil do Usuário</h1>

    <!-- Formulário de atualização de informações -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Informações Pessoais</h5>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
    </div>

    <!-- Formulário de alteração de senha -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Alterar Senha</h5>
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="password" class="form-label">Nova Senha</label>
                    <input type="password" class="form-control" id="password" name="password">
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-warning">Alterar Senha</button>
            </form>
        </div>
    </div>

    <!-- Botão de exclusão de conta -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title text-danger">Excluir Conta</h5>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir sua conta?')">
                    Excluir Conta
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
