<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class vistasController extends Controller
{
    public function viewMovimiento($event, $id = ''){
        return view('poncheras.movimientos.nuevo', [
            'idmovimiento' => $id,
            'evento' => $event
        ]);
    }
}
