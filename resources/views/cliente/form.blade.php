@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12">
        <h2>{{ isset($data) ? 'Editar Cliente' : 'Cadastrar Cliente' }}</h2>
        
        <form action="{{ isset($data) ? route('cliente.update', $data->id) : route('cliente.store') }}" method="POST">
            @csrf
            @if(isset($data))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $data->nome ?? old('nome') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">CPF/CNPJ: </label>
                <input type="text" name="cpf_cnpj" class="form-control" value="{{ $data->cpf_cnpj ?? old('cpf_cnpj') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Telefone: </label>
                <input type="text" name="telefone" class="form-control" value="{{ $data->telefone ?? old('telefone') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Endereço: </label>
                <input type="text" name="endereco" class="form-control" value="{{ $data->endereco ?? old('endereco') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Email: </label>
                <input type="email" name="email" class="form-control" value="{{ $data->email ?? old('email') }}">
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('cliente.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</div>
@endsection