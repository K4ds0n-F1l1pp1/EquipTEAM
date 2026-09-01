@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <h2>{{ isset($data) ? 'Editar Locação' : 'Cadastrar Locação' }}</h2>
        
        <form action="{{ isset($data) ? route('locacao.update', $data->id) : route('locacao.store') }}" method="POST">
            @csrf
            @if(isset($data))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Cliente: </label>
                <select name="cliente_id" class="form-control">
                    <option value="">Selecione um cliente</option>

                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ (isset($data) && $data->cliente_id == $cliente->id) ? 'selected' : '' }}>
                            {{ $cliente->nome }}
                        </option>
                    @endforeach
                    
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Equipamento: </label>
                <select name="equipamento_id" class="form-control">
                    <option value="">Selecione um equipamento</option>

                    @foreach($equipamentos as $equipamento)
                        <option value="{{ $equipamento->id }}" {{ (isset($data) && $data->equipamento_id == $equipamento->id) ? 'selected' : '' }}>
                            {{ $equipamento->nome }}
                        </option>
                    @endforeach
                    
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Retirada: </label>
                <input type="date" name="data_retirada" class="form-control" value="{{ $data->data_retirada ?? old('data_retirada') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Devolução: </label>
                <input type="date" name="data_devolucao_previsa" class="form-control" value="{{ $data->data_devolucao_previsa ?? old('data_devolucao_previsa') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Valor Total: </label>
                <input type="number" name="valor_total" class="form-control" value="{{ $data->valor_total ?? old('valor_total') }}" step="0.01">
            </div>

            <div>
                <label class="form-label">Status: </label>
                <select name="status" class="form-control">
                    <option value="">Selecione um status</option>
                    <option value="disponivel" {{ ($data->status ?? '') == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                    <option value="alugado" {{ ($data->status ?? '') == 'alugado' ? 'selected' : '' }}>Alugado</option>
                    <option value="manutencao" {{ ($data->status ?? '') == 'manutencao' ? 'selected' : '' }}>Manutenção</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('locacao.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</div>
@endsection