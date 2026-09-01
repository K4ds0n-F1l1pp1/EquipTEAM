@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Locações</h2>
        <a href="{{ route('locacao.create') }}" class="btn btn-primary">Nova Locação</a>
    </div>

    <div class="col-12 mb-3">
        <form action="{{ route('locacao.index') }}" method="GET" class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nome..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>

                @if(isset($search))
                    <a href="{{ route('locacao.index') }}" class="btn btn-outline-danger">Limpar</a>
                @endif
                
        </form>
    </div>

    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Equipamento</th>
                    <th>Data de Retirada</th>
                    <th>Data de Devolução</th>
                    <th>Valor Total</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dados as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->cliente->nome ?? 'N/A' }}</td>
                    <td>{{ $item->equipamento->nome ?? 'N/A' }}</td>
                    <td>{{ $item->data_retirada }}</td>
                    <td>{{ $item->data_devolucao_previsa }}</td>
                    <td>{{ $item->valor_total }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('locacao.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('locacao.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?')">Deletar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhuma locação cadastrada.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection