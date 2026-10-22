@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold">EquipTEAM</h3>
                    <p class="text-muted">Faça login para acessar o sistema</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 ps-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="master@equipteam.com" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" placeholder="********" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Entrar
                    </button>
                </form>

                <div class="mt-4 p-3 bg-light rounded text-center small text-muted">
                    <strong>Master Padrão:</strong><br>
                    E-mail: <code>master@equipteam.com</code><br>
                    Senha: <code>12345678</code>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection