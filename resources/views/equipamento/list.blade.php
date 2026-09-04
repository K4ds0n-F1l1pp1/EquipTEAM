@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Lista de Equipamentos</h2>
            <a href="{{ route('equipamentos.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i> Novo Equipamento
            </a>
        </div>

        <div class="card shadow-sm mb-4 border-0">
            <div class="card-body">
                <form action="{{ route('equipamentos.index') }}" method="GET" class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nome..." value="{{ $search ?? '' }}">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                    @if(isset($search) && $search != '')
                        <a href="{{ route('equipamentos.index') }}" class="btn btn-outline-danger">Limpar</a>
                    @endif
                </form>
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">ID</th>
                                <th>Nome</th>
                                <th>Nº Série</th>
                                <th>Valor Diária</th>
                                <th>Status</th>
                                <th class="text-end pe-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dados as $item)
                            <tr>
                                <td class="ps-3">{{ $item->id }}</td>
                                <td><strong>{{ $item->nome }}</strong></td>
                                <td>{{ $item->numero_serie }}</td>
                                <td>R$ {{ number_format($item->valor_diaria, 2, ',', '.') }}</td>
                                <td>
                                    @php
                                        $badgeClass = match($item->status) {
                                            'disponivel' => 'bg-success',
                                            'alugado' => 'bg-warning text-dark',
                                            'manutencao' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($item->status) }}</span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('equipamentos.edit', $item->id) }}" class="btn btn-sm btn-light text-warning" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('equipamentos.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Deletar" onclick="return confirm('Deseja excluir?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Nenhum equipamento cadastrado.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
