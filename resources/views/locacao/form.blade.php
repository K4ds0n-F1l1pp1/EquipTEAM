@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <h2>{{ isset($data) ? 'Editar Locação' : 'Cadastrar Locação' }}</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
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

                @if($equipamentos->isEmpty())
                    <small class="text-danger">Nenhum equipamento disponível no momento.</small>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Retirada: </label>
                <input type="date" name="data_retirada" class="form-control" value="{{ $data->data_retirada ?? old('data_retirada') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Devolução: </label>
                <input type="date" name="data_devolucao_previsa" class="form-control" value="{{ $data->data_devolucao_previsa ?? old('data_devolucao_previsa') }}">
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('locacao.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</div>
@endsection