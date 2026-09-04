@extends('layouts.app')

@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('equipamentos.index') }}" class="btn btn-icon btn-light me-3 shadow-sm" title="Voltar">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="mb-0">{{ isset($data) ? 'Editar Equipamento' : 'Cadastrar Equipamento' }}</h2>
        </div>

        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ isset($data) ? route('equipamentos.update', $data->id) : route('equipamentos.store') }}" method="POST">
                    @csrf
                    @if(isset($data))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" name="nome" class="form-control" value="{{ $data->nome ?? old('nome') }}" placeholder="Nome do equipamento">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Número de Série</label>
                            <input type="text" name="numero_serie" class="form-control" value="{{ $data->numero_serie ?? old('numero_serie') }}" placeholder="Ex: SN-12345">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Valor da Diária (R$)</label>
                            <input type="text" name="valor_diaria" class="form-control" value="{{ $data->valor_diaria ?? old('valor_diaria') }}" placeholder="0.00">
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select">
                                <option value="disponivel" {{ ($data->status ?? old('status')) == 'disponivel' ? 'selected' : '' }}>Disponível</option>
                                <option value="alugado" {{ ($data->status ?? old('status')) == 'alugado' ? 'selected' : '' }}>Alugado</option>
                                <option value="manutencao" {{ ($data->status ?? old('status')) == 'manutencao' ? 'selected' : '' }}>Manutenção</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-lg me-1"></i> Salvar
                        </button>
                        <a href="{{ route('equipamentos.index') }}" class="btn btn-light px-4">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
