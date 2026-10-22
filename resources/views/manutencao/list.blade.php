@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12 d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Manutenções</h2>
            <small class="text-muted">Gerencie as manutenções de equipamentos</small>
        </div>
        <a href="{{ route('manutencao.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Nova Manutenção
        </a>
    </div>

    <div class="col-12 mb-4">
        <form action="{{ route('manutencao.index') }}" method="GET" class="input-group">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" name="search" class="form-control" placeholder="Buscar por descrição..." value="{{ $search ?? '' }}">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            @if(isset($search) && $search != '')
                <a href="{{ route('manutencao.index') }}" class="btn btn-outline-danger">
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
                        <th>Equipamento</th>
                        <th>Descrição</th>
                        <th>Data da Manutenção</th>
                        <th>Custo</th>
                        <th>Foto</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dados as $item)
                    <tr>
                        <td class="text-muted">#{{ $item->id }}</td>
                        <td class="fw-semibold">{{ $item->equipamento->nome ?? 'N/A' }}</td>
                        <td>{{ $item->descricao }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->data_manutencao)->format('d/m/Y') }}</td>
                        <td class="fw-semibold">R$ {{ number_format($item->custo, 2, ',', '.') }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Manutenção" width="60" class="img-thumbnail rounded">
                            @else
                                <span class="text-muted small">Sem foto</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('manutencao.edit', $item->id) }}" class="btn btn-icon btn-warning btn-sm" title="Editar">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form action="{{ route('manutencao.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-icon btn-danger btn-sm" title="Excluir" onclick="return confirm('Deseja excluir esta manutenção?')">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            Nenhuma manutenção cadastrada.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection