<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LocacaoController;
use App\Http\Controllers\EquipamentosController;

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

Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente.index'); // Chama a função de exibição.
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create'); // Chama a função de criar o cliente.
Route::post('/cliente/store', [ClienteController::class, 'store'])->name('cliente.store');
Route::get('/cliente/edit/{id}', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

Route::get('/locacao', [LocacaoController::class, 'index'])->name('locacao.index'); // Chama a função de exibição.
Route::get('/locacao/create', [LocacaoController::class, 'create'])->name('locacao.create'); // Chama a função de criar a locação.
Route::post('/locacao/store', [LocacaoController::class, 'store'])->name('locacao.store');
Route::get('/locacao/edit/{id}', [LocacaoController::class, 'edit'])->name('locacao.edit');
Route::put('/locacao/update/{id}', [LocacaoController::class, 'update'])->name('locacao.update');
Route::delete('/locacao/{id}', [LocacaoController::class, 'destroy'])->name('locacao.destroy');

Route::get('/equipamento', [EquipamentosController::class, 'index'])->name('equipamentos.index');
Route::get('/equipamento/create', [EquipamentosController::class, 'create'])->name('equipamentos.create');
Route::post('/equipamento/store', [EquipamentosController::class, 'store'])->name('equipamentos.store');
Route::get('/equipamento/edit/{id}', [EquipamentosController::class, 'edit'])->name('equipamentos.edit');
Route::put('/equipamento/update/{id}', [EquipamentosController::class, 'update'])->name('equipamentos.update');
Route::delete('/equipamento/{id}', [EquipamentosController::class, 'destroy'])->name('equipamentos.destroy');
