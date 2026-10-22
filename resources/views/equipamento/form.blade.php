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
                <form action="{{ isset($data) ? route('equipamentos.update', $data->id) : route('equipamentos.store') }}" method="POST" enctype="multipart/form-data">
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
                        <label class="form-label">Foto do Equipamento</label>
                        <input type="file" name="foto" class="form-control">
                        @if(isset($data) && $data->foto)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $data->foto) }}" width="100" class="img-thumbnail">
                            </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status do Equipamento</label>
                        <select name="status" class="form-select">
                            <option value="disponivel" {{ (isset($data) && $data->status == 'disponivel') ? 'selected' : '' }}>Disponível</option>
                            <option value="alugado" {{ (isset($data) && $data->status == 'alugado') ? 'selected' : '' }}>Alugado</option>
                            <option value="manutencao" {{ (isset($data) && $data->status == 'manutencao') ? 'selected' : '' }}>Em Manutenção</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="{{ route('equipamentos.index') }}" class="btn btn-secondary">Voltar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
