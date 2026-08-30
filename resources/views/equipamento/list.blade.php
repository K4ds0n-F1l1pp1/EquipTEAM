@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Equipamentos</h2>
        <a href="{{ route('equipamentos.create') }}" class="btn btn-primary">Novo Equipamento</a>
    </div>

    <div class="col-12 mb-3">
        <form action="{{ route('equipamentos.index') }}" method="GET" class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nome..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>

                @if(isset($search))
                    <a href="{{ route('equipamentos.index') }}" class="btn btn-outline-danger">Limpar</a>
                @endif
                
        </form>
    </div>

    <div class="col-12">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Nº Série</th>
                    <th>Valor Diária</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dados as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->numero_serie }}</td>
                    <td>R$ {{ number_format($item->valor_diaria, 2, ',', '.') }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('equipamentos.edit', $item->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('equipamentos.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?')">Deletar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhum equipamento cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection