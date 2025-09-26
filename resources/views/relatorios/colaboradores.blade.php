@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Relatório de Colaboradores</h1>

        <form method="GET" action="{{ route('relatorios.colaboradores') }}" class="mb-3">
            <div class="row g-2">
                <div class="col">
                    <select name="grupo_id" class="form-control">
                        <option value="">Todos os Grupos</option>
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}" {{ request('grupo_id') == $grupo->id ? 'selected' : '' }}>
                                {{ $grupo->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="bandeira_id" class="form-control">
                        <option value="">Todas as Bandeiras</option>
                        @foreach ($bandeiras as $bandeira)
                            <option value="{{ $bandeira->id }}"
                                {{ request('bandeira_id') == $bandeira->id ? 'selected' : '' }}>
                                {{ $bandeira->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select name="unidade_id" class="form-control">
                        <option value="">Todas as Unidades</option>
                        @foreach ($unidades as $unidade)
                            <option value="{{ $unidade->id }}"
                                {{ request('unidade_id') == $unidade->id ? 'selected' : '' }}>
                                {{ $unidade->nome_fantasia }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <div>
                        <button type="submit" class="btn btn-dark">Filtrar</button>
                        <button type="button" id="exportBtn" class="btn btn-warning">Exportar Excel</button>
                    </div>
                    <span id="exportStatus"></span>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Unidade</th>
                    <th>Criado em</th>
                </tr>
            </thead>
            <tbody>
                @forelse($colaboradores as $colaborador)
                    <tr>
                        <td>{{ $colaborador->nome }}</td>
                        <td>{{ $colaborador->email }}</td>
                        <td>{{ $colaborador->cpf }}</td>
                        <td>{{ $colaborador->unidade->nome_fantasia ?? '' }}</td>
                        <td>{{ $colaborador->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum colaborador encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $colaboradores->links() }}
    </div>

    <script>
        document.getElementById('exportBtn').addEventListener('click', function() {
            const btn = this;
            const status = document.getElementById('exportStatus');
            btn.disabled = true;
            status.textContent = 'Gerando arquivo...';

            fetch("{{ route('relatorios.colaboradores.export') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    if (res.error) {
                        status.textContent = res.error;
                        btn.disabled = false;
                    } else {
                        const fileUrl = "/storage/exports/" + res.file_name + ".xlsx";

                        const interval = setInterval(() => {
                            fetch(fileUrl, {
                                    method: 'HEAD'
                                })
                                .then(r => {
                                    if (r.ok) {
                                        clearInterval(interval);
                                        status.textContent = 'Download iniciado!';
                                        btn.disabled = false;

                                        const a = document.createElement('a');
                                        a.href = fileUrl;
                                        a.download = res.file_name + ".xlsx";
                                        document.body.appendChild(a);
                                        a.click();
                                        a.remove();
                                    }
                                })
                        }, 2000);
                    }
                });
        });
    </script>
@endsection
