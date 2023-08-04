<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovimientosController as Movimientos_v1;
use App\Http\Controllers\VistasController as Vistas_v1;
use App\Http\Controllers\EstadosController as Estados_v1;
use App\Http\Controllers\ColaboradoresController as Colaborador_v1;
use App\Http\Controllers\EstadoPagosController as EstadoPago_v1;
use App\Http\Controllers\TipoPonchesController as Tponches_v1; 


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('v1')->group(function(){
    Route::apiResources([
        'movimientos' => Movimientos_v1::class,
        'estados' => Estados_v1::class,
        'colaborador' => Colaborador_v1::class,
        'estadopago' => EstadoPago_v1::class,
        'tiposPoncheras' => Tponches_v1::class,
        
    ]);
});

Route::prefix('movimiento')->group(function(){
    Route::view('/','poncheras.movimientos.listar');
    Route::get('/{event}/{id?}', [Vistas_v1::class, 'viewMovimiento']);
});

Route::prefix('colaborador')->group(function(){
    Route::view('/','poncheras.colaborador.listar');
    Route::get('/{event}/{id?}', [Vistas_v1::class, 'viewColaborador']);
});

Route::prefix('estadopago')->group(function(){
    Route::view('/','poncheras.estadopago.listar');
    Route::get('/{event}/{id?}', [Vistas_v1::class, 'vieEstadoPago']);
});

Route::prefix('estados')->group(function(){
    Route::view('/','poncheras.estados.listar');
    Route::get('/{event}/{id?}',[vistas_v1::class, 'viewEstado']);

});

require __DIR__.'/auth.php';
