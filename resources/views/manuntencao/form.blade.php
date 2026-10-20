@extends('layouts.app')

@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('locacao.index') }}" class="btn btn-icon btn-light me-3" title="Voltar">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="mb-0">{{ isset($data) ? 'Editar Locação' : 'Nova Locação' }}</h2>
        </div>

        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
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

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="cliente_id" class="form-select">
                        <option value="">Selecione um cliente</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}" {{ (isset($data) && $data->cliente_id == $cliente->id) ? 'selected' : '' }}>
                                {{ $cliente->nome }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Equipamento</label>
                    <select name="equipamento_id" class="form-select">
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

                <div class="col-md-6 mb-3">
                    <label class="form-label">Data de Retirada</label>
                    <input type="date" name="data_retirada" class="form-control" value="{{ $data->data_retirada ?? old('data_retirada') }}">
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Data de Devolução</label>
                    <input type="date" name="data_devolucao_previsa" class="form-control" value="{{ $data->data_devolucao_previsa ?? old('data_devolucao_previsa') }}">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-lg me-1"></i> Salvar
                </button>
                <a href="{{ route('locacao.index') }}" class="btn btn-light px-4">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
