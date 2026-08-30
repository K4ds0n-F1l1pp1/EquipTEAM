@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <h2>{{ isset($data) ? 'Editar Equipamento' : 'Cadastrar Equipamento' }}</h2>
        
        <form action="{{ isset($data) ? route('equipamentos.update', $data->id) : route('equipamentos.store') }}" method="POST">
            @csrf
            @if(isset($data))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $data->nome ?? old('nome') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Número de Série</label>
                <input type="text" name="numero_serie" class="form-control" value="{{ $data->numero_serie ?? old('numero_serie') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Valor da Diária (R$)</label>
                <input type="text" name="valor_diaria" class="form-control" value="{{ $data->valor_diaria ?? old('valor_diaria') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="disponivel" {{ ($data->status ?? '') == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                    <option value="alugado" {{ ($data->status ?? '') == 'alugado' ? 'selected' : '' }}>Alugado</option>
                    <option value="manutencao" {{ ($data->status ?? '') == 'manutencao' ? 'selected' : '' }}>Manutenção</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</div>
@endsection