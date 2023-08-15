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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/emergente', function () {
    return view('layouts.emergente');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('movimiento')->group(function(){
        Route::view('/','poncheras.movimientos.listar')->name('MovimientoListar');
        Route::get('/list', [Movimientos_v1::class, 'list']);
        Route::get('/{event}/{id?}', [Vistas_v1::class, 'viewMovimiento'])->name('MovimientoNuevo');
        Route::delete('/{id?}',[Movimientos_v1::class, 'destroy']);
       
    });

    Route::prefix('colaborador')->group(function(){
        Route::view('/','poncheras.colaboradores.listar')->name('ColaboradorListar');
        Route::get('/list', [Colaborador_v1::class, 'list']);
        Route::get('/{event}/{id?}', [Vistas_v1::class, 'viewColaborador'])->name('ColaboradorNuevo');
    });

    Route::prefix('tipoponchera')->group(function(){
        Route::view('/','poncheras.tipoPoncheras.listar')->name('TipoPoncheraListar');
        Route::get('/list', [Tponches_v1::class, 'list']);
        Route::get('/{event}/{id?}', [Vistas_v1::class, 'viewTipoPonchera'])->name('TipoPoncheraNuevo');
    });
    
    Route::prefix('estadopago')->group(function(){
        Route::view('/','poncheras.estadosPagos.listar')->name('EstadoPagoListar');
        Route::get('/list', [EstadoPago_v1::class, 'list']);
        Route::get('/{event}/{id?}', [Vistas_v1::class, 'viewEstadoPago'])->name('EstadoPagoNuevo');
    });

    Route::prefix('estados')->group(function(){
        Route::view('/','poncheras.estados.listar')->name('EstadosListar');
        Route::get('/list', [Estados_v1::class, 'list']);
        Route::get('/{event}/{id?}',[vistas_v1::class, 'viewEstado'])->name('EstadosNuevo');
    
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
      
});






require __DIR__.'/auth.php';
