@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Pagamentos</h2>
            <small class="text-muted">Gerencie os pagamentos das locações</small>
        </div>
        <a href="{{ route('pagamento.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Novo Pagamento
        </a>
    </div>

    <div class="col-12 mb-4">
        <form action="{{ route('pagamento.index') }}" method="GET" class="input-group">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control" placeholder="Buscar por status ou forma de pagamento..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            @if(isset($search) && $search != '')
                <a href="{{ route('pagamento.index') }}" class="btn btn-outline-danger">
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
                        <th>Locação</th>
                        <th>Valor</th>
                        <th>Forma de Pagamento</th>
                        <th>Status</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dados as $item)
                    <tr>
                        <td class="text-muted">#{{ $item->id }}</td>
                        <td class="fw-semibold">Locação #{{ $item->locacao_id }} - {{ $item->locacao->cliente->nome ?? 'N/A' }}</td>
                        <td class="fw-semibold">R$ {{ number_format($item->valor, 2, ',', '.') }}</td>
                        <td>{{ $item->forma_pagamento }}</td>
                        <td>
                            @if($item->status == 'Pago')
                                <span class="badge bg-success">Pago</span>
                            @else
                                <span class="badge bg-warning text-dark">Pendente</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('pagamento.edit', $item->id) }}" class="btn btn-icon btn-warning btn-sm" title="Editar">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('pagamento.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-danger btn-sm" title="Excluir" onclick="return confirm('Deseja excluir este pagamento?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Nenhum pagamento cadastrado.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection