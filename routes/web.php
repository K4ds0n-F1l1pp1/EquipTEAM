<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\EquipamentosController;
use App\Http\Controllers\ManutencaoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return view('/menu');
    }
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/', [EquipamentosController::class, 'menu'])->name('menu');
    
    // ==========================================
    // CLIENTES
    // ==========================================
    Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index'); // Chama a função de exibição.
    Route::post('/cliente/search', [ClienteController::class, 'search'])->name('cliente.search'); // Chama a função de busca.
    Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create'); // Chama a função de criar o cliente.
    Route::post('/cliente/store', [ClienteController::class, 'store'])->name('cliente.store');
    Route::get(
        '/cliente/edit/{id}',
        [ClienteController::class, 'edit']
    )->name('cliente.edit');
    Route::put(
        '/cliente/update/{id}',
        [ClienteController::class, 'update']
    )->name('cliente.update');
    Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

    // ==========================================
    // LOCAÇÕES
    // ==========================================
    Route::get('/locacao', [LocacaoController::class, 'index'])->name('locacao.index'); // Chama a função de exibição.
    Route::post('/locacao/search', [LocacaoController::class, 'search'])->name('locacao.search'); // Chama a função de busca.
    Route::get('/locacao/create', [LocacaoController::class, 'create'])->name('locacao.create'); // Chama a função de criar a locação.
    Route::post('/locacao/store', [LocacaoController::class, 'store'])->name('locacao.store');
    Route::get(
        '/locacao/edit/{id}',
        [LocacaoController::class, 'edit']
    )->name('locacao.edit');
    Route::put(
        '/locacao/update/{id}',
        [LocacaoController::class, 'update']
    )->name('locacao.update');
    Route::delete('/locacao/{id}', [LocacaoController::class, 'destroy'])->name('locacao.destroy');

    // ==========================================
    // EQUIPAMENTOS
    // ==========================================
    Route::get('/equipamento', [EquipamentosController::class, 'index'])->name('equipamentos.index'); // Chama a função de exibição.
    Route::post('/equipamento/search', [EquipamentosController::class, 'search'])->name('equipamentos.search'); // Chama a função de busca.
    Route::get('/equipamento/create', [EquipamentosController::class, 'create'])->name('equipamentos.create'); // Chama a função de criar o equipamento.
    Route::post('/equipamento/store', [EquipamentosController::class, 'store'])->name('equipamentos.store');
    Route::get(
        '/equipamento/edit/{id}',
        [EquipamentosController::class, 'edit']
    )->name('equipamentos.edit');
    Route::put(
        '/equipamento/update/{id}',
        [EquipamentosController::class, 'update']
    )->name('equipamentos.update');
    Route::delete('/equipamento/{id}', [EquipamentosController::class, 'destroy'])->name('equipamentos.destroy');

    // ==========================================
    // MANUTENÇÕES (1:N com Equipamentos)
    // ==========================================
    Route::get('/manutencao', [ManutencaoController::class, 'index'])->name('manutencao.index'); // Chama a função de exibição.
    Route::post('/manutencao/search', [ManutencaoController::class, 'search'])->name('manutencao.search'); // Chama a função de busca.
    Route::get('/manutencao/create', [ManutencaoController::class, 'create'])->name('manutencao.create'); // Chama a função de criar a manutenção.
    Route::post('/manutencao/store', [ManutencaoController::class, 'store'])->name('manutencao.store');
    Route::get(
        '/manutencao/edit/{id}',
        [ManutencaoController::class, 'edit']
    )->name('manutencao.edit');
    Route::put(
        '/manutencao/update/{id}',
        [ManutencaoController::class, 'update']
    )->name('manutencao.update');
    Route::delete('/manutencao/{id}', [ManutencaoController::class, 'destroy'])->name('manutencao.destroy');

    // ==========================================
    // PAGAMENTOS (1:1 com Locações)
    // ==========================================
    Route::get('/pagamento', [PagamentoController::class, 'index'])->name('pagamento.index'); // Chama a função de exibição.
    Route::post('/pagamento/search', [PagamentoController::class, 'search'])->name('pagamento.search'); // Chama a função de busca.
    Route::get('/pagamento/create', [PagamentoController::class, 'create'])->name('pagamento.create'); // Chama a função de criar o pagamento.
    Route::post('/pagamento/store', [PagamentoController::class, 'store'])->name('pagamento.store');
    Route::get(
        '/pagamento/edit/{id}',
        [PagamentoController::class, 'edit']
    )->name('pagamento.edit');
    Route::put(
        '/pagamento/update/{id}',
        [PagamentoController::class, 'update']
    )->name('pagamento.update');
    Route::delete('/pagamento/{id}', [PagamentoController::class, 'destroy'])->name('pagamento.destroy');
    
});

