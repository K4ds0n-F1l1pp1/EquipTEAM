<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LocacaoController;

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

Route::get('/cliente', [ClienteController::class, 'index']); // Chama a função de exibição.
Route::get('/cliente/create', [ClienteController::class, 'create']); // Chama a função de criar o cliente.

Route::get('/locacao', [LocacaoController::class, 'index']); // Chama a função de exibição.
Route::get('/locacao/create', [LocacaoController::class, 'create']); // Chama a função de criar a locação.

Route::get('/equipamento', [EquipamentoController::class, 'index']); // Chama a função de exibição.
Route::get('/equipamento/create', [EquipamentoController::class, 'create']); // Chama a função de criar os Equipamentos.
