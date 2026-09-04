@extends('layouts.app')

@section('content')
<div class="row mt-4">
    <div class="col-12 text-center mb-5">
        <h1>Bem-vindo ao EquipTEAM</h1>
        <p class="text-muted">Sistema de Locação de Equipamentos</p>
    </div>

    <div class="col-md-4 mb-4 d-flex">
        <div class="card text-center shadow-sm h-100 w-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Equipamentos</h5>
                <p class="card-text flex-grow-1">Gerencie os equipamentos disponíveis para locação.</p>
                <a href="{{ route('equipamentos.index') }}" class="btn btn-primary mt-auto">Ver Equipamentos</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4 d-flex">
        <div class="card text-center shadow-sm h-100 w-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Clientes</h5>
                <p class="card-text flex-grow-1">Controle dos clientes cadastrados.</p>
                <a href="{{ route('cliente.index') }}" class="btn btn-primary mt-auto">Ver Clientes</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4 d-flex">
        <div class="card text-center shadow-sm h-100 w-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">Locações</h5>
                <p class="card-text flex-grow-1">Adicione as locações efetuadas.</p>
                <a href="{{ route('locacao.index') }}" class="btn btn-primary mt-auto">Ver Locações</a>
            </div>
        </div>
    </div>
</div>
@endsection