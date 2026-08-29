@extends('layouts.app')

@section('content')
<div class="p-5 mb-4 bg-white rounded-3 shadow-sm border">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold text-primary">Sistema de Controle de Locação</h1>
        <p class="col-md-8 fs-4 text-muted">Gerencie equipamentos, clientes e locações de forma rápida e organizada para o seu projeto.</p>
        <hr class="my-4">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Equipamentos</h5>
                        <p class="card-text text-muted">Cadastre e controle o estoque de itens disponíveis.</p>
                        <a href="{{ route('equipamentos.index') }}" class="btn btn-primary">Acessar Equipamentos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text text-muted">Gerencie o cadastro dos clientes locatários.</p>
                        <a href="{{ route('clientes.index') }}" class="btn btn-success">Acessar Clientes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Locações</h5>
                        <p class="card-text text-muted">Registre e acompanhe os aluguéis ativos.</p>
                        <a href="{{ route('locacoes.index') }}" class="btn btn-warning text-dark">Acessar Locações</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection