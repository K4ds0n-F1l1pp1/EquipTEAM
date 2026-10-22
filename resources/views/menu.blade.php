@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row text-center mb-4">
        <div class="col-12">
            <h1 class="fw-bold">EquipTEAM - Menu Principal</h1>
            <p class="text-muted">Painel de controlo e indicadores do sistema</p>
        </div>
    </div>

    <!-- Atalhos dos módulos -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center p-3 h-100">
                <div class="card-body">
                    <i class="bi bi-tools display-5 text-primary mb-2"></i>
                    <h5>Equipamentos</h5>
                    <a href="{{ route('equipamentos.index') }}" class="btn btn-outline-primary btn-sm stretched-link">Aceder</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center p-3 h-100">
                <div class="card-body">
                    <i class="bi bi-people display-5 text-success mb-2"></i>
                    <h5>Clientes</h5>
                    <a href="{{ route('cliente.index') }}" class="btn btn-outline-success btn-sm stretched-link">Aceder</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm border-0 text-center p-3 h-100">
                <div class="card-body">
                    <i class="bi bi-calendar-check display-5 text-warning mb-2"></i>
                    <h5>Locações</h5>
                    <a href="{{ route('locacao.index') }}" class="btn btn-outline-warning btn-sm stretched-link">Aceder</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Secção dos Gráficos (Lado a lado) -->
    <div class="row">
        <!-- Gráfico 1: Barras -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 p-3 h-100">
                <h5 class="fw-bold text-center mb-3">Status dos Equipamentos</h5>
                {!! $chartStatus->container() !!}
            </div>
        </div>

        <!-- Gráfico 2: Rosca/Donut -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm border-0 p-3 h-100">
                <h5 class="fw-bold text-center mb-3">Formas de Pagamento</h5>
                {!! $chartPagamento->container() !!}
            </div>
        </div>
    </div>
</div>

<!-- Scripts dos gráficos -->
<script src="{{ $chartStatus->cdn() }}"></script>
{!! $chartStatus->script() !!}
{!! $chartPagamento->script() !!}
@endsection