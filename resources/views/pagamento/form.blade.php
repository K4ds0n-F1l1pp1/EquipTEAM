@extends('layouts.app')

@section('content')
<div class="row mt-4 justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('pagamento.index') }}" class="btn btn-icon btn-light me-3" title="Voltar">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h2 class="mb-0">{{ isset($data) ? 'Editar Pagamento' : 'Novo Pagamento' }}</h2>
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

        <form action="{{ isset($data) ? route('pagamento.update', $data->id) : route('pagamento.store') }}" method="POST">
            @csrf
            @if(isset($data))
                @method('PUT')
            @endif

            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Locação</label>
                    <select name="locacao_id" class="form-select">
                        <option value="">Selecione a locação</option>
                        @foreach($locacoes as $locacao)
                            <option value="{{ $locacao->id }}" {{ (isset($data) && $data->locacao_id == $locacao->id) ? 'selected' : '' }}>
                                Locação #{{ $locacao->id }} - Cliente: {{ $locacao->cliente->nome ?? 'N/A' }} (R$ {{ number_format($locacao->valor_total ?? 0, 2, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Valor (R$)</label>
                    <input type="text" name="valor" class="form-control" value="{{ $data->valor ?? old('valor') }}" placeholder="0,00">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Forma de Pagamento</label>
                    <select name="forma_pagamento" class="form-select">
                        <option value="">Selecione a forma</option>
                        <option value="Pix" {{ (isset($data) && $data->forma_pagamento == 'Pix') ? 'selected' : '' }}>Pix</option>
                        <option value="Cartão de Crédito" {{ (isset($data) && $data->forma_pagamento == 'Cartão de Crédito') ? 'selected' : '' }}>Cartão de Crédito</option>
                        <option value="Cartão de Débito" {{ (isset($data) && $data->forma_pagamento == 'Cartão de Débito') ? 'selected' : '' }}>Cartão de Débito</option>
                        <option value="Dinheiro" {{ (isset($data) && $data->forma_pagamento == 'Dinheiro') ? 'selected' : '' }}>Dinheiro</option>
                    </select>
                </div>

                <div class="col-md-12 mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="Pendente" {{ (isset($data) && $data->status == 'Pendente') ? 'selected' : '' }}>Pendente</option>
                        <option value="Pago" {{ (isset($data) && $data->status == 'Pago') ? 'selected' : '' }}>Pago</option>
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bi bi-check-lg me-1"></i> Salvar
                </button>
                <a href="{{ route('pagamento.index') }}" class="btn btn-light px-4">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection