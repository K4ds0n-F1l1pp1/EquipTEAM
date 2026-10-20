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

        <form action="{{ isset($data) ? route('manutencoes.update', $data->id) : route('manutencoes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($data))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Equipamento</label>
                <select name="equipamento_id" class="form-control">
                    @foreach($equipamentos as $eq)
                        <option value="{{ $eq->id }}" {{ (isset($data) && $data->equipamento_id == $eq->id) ? 'selected' : '' }}>
                            {{ $eq->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Descrição do Problema / Serviço</label>
                <textarea name="descricao" class="form-control">{{ $data->descricao ?? old('descricao') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Data da Manutenção</label>
                <input type="date" name="data_manutencao" class="form-control" value="{{ $data->data_manutencao ?? old('data_manutencao') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Custo (R$)</label>
                <input type="text" name="custo" class="form-control" value="{{ $data->custo ?? old('custo') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Foto do Reparo / Peça</label>
                <input type="file" name="foto" class="form-control">
                @if(isset($data) && $data->foto)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $data->foto) }}" width="100" class="img-thumbnail">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('manutencoes.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</div>
@endsection
