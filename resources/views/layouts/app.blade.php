<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EquipTEAM - Sistema de Locação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="{{ asset('css/customlegal.css') }}" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">EquipTEAM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Início</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('equipamentos.index') }}">Equipamentos</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('locacao.index') }}">Locações</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('manutencao.index') }}">Manutenções</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('pagamento.index') }}">Pagamentos</a></li>
                </ul>

                @auth
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item text-light me-2 small opacity-75">
                            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-inline">
                                @csrf
                                <a href="#" class="nav-link text-secondary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-1"></i> Sair
                                </a>
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>