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
    public function viewTipoPonchera($event, $id = ''){
        return view('poncheras.tipoPoncheras.nuevo', [
            'idponches' => $id,
            'evento' => $event
        ]);
    }
    public function viewColaborador($event, $id = ''){
        return view('poncheras.colaboradores.nuevo', [
            'idcolaborador' => $id,
            'evento' => $event
        ]);
    }
    public function viewEstadoPago($event, $id = ''){
        return view('poncheras.estadosPagos.nuevo', [
            'idestadopago' => $id,
            'evento' => $event
        ]);
    }
    public function viewEstado($event, $id = ''){
        return view('poncheras.estados.nuevo', [
            'idestado' => $id,
            'evento' => $event
        ]);
    }
}            
