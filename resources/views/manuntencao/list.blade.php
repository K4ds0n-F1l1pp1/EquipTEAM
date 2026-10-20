@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Locações</h2>
            <small class="text-muted">Gerencie os aluguéis de equipamentos</small>
        </div>
        <a href="{{ route('locacao.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nova Locação
        </a>
    </div>

    <div class="col-12 mb-4">
        <form action="{{ route('locacao.index') }}" method="GET" class="input-group">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control" placeholder="Buscar por cliente..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            @if(isset($search))
                <a href="{{ route('locacao.index') }}" class="btn btn-outline-danger">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </form>
    </div>

    <div class="col-12">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Equipamento</th>
                        <th>Retirada</th>
                        <th>Devolução</th>
                        <th>Valor</th>
                        <th>Status</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dados as $item)
                    <tr>
                        <td class="text-muted">#{{ $item->id }}</td>
                        <td class="fw-semibold">{{ $item->cliente->nome ?? 'N/A' }}</td>
                        <td>{{ $item->equipamento->nome ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->data_retirada)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->data_devolucao_previsa)->format('d/m/Y') }}</td>
                        <td class="fw-semibold">R$ {{ number_format($item->valor_total, 2, ',', '.') }}</td>
                        <td>
                            @if($item->status == 'ativa' || $item->status == 'alugado')
                                <span class="badge-status badge-ativa">Ativa</span>
                            @elseif($item->status == 'finalizada')
                                <span class="badge-status badge-finalizada">Finalizada</span>
                            @else
                                <span class="badge-status badge-outro">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('locacao.edit', $item->id) }}" class="btn btn-icon btn-warning" title="Editar">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('locacao.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-danger" title="Excluir" onclick="return confirm('Deseja excluir esta locação?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Nenhuma locação cadastrada.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
