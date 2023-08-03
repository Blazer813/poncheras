<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estadoPago;
use Exception;

class EstadoPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = [];
        try {
            $nuevoestadopago = new estadopago();
            $nuevoestadopago->nomestado = $request->nomestado;

            if(!$nuevoestadopago->save()){
                throw new Exception("Error al crear el colaborador", 101);
            }
            $response['type'] = 'Success';
            $response['title'] = 'Creacion del colaborador';
            $response['msg'] = 'Se creo el colaborador con exito';
        } catch (\Throwable $th) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al crear el colaborador';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $response = [];
        $selectCampos = [
            'idestadopago',
            'nomestado',
        ];

        $coleccionEstadosPagos = collect([]);

        switch ($id) {
            case '@':
                $estadospagos = estadopago::select($selectCampos)->get();
                foreach($estadospagos as $key => $value){
                    $coleccionAux = collect([
                        [
                        'it' => $key + 1,
                        'idestadopago' => $value->idestadopago,
                        'nomestado' => $value->nomestado,
                        ]
                    ]);
                    $coleccionEstadosPagos = $coleccionAux->concat($coleccionEstadosPagos);
                }
                break;
            
            default:
            $estadospagos = estadopago::select($selectCampos)->where('idestadopago', $id)->first();
            $coleccionEstadosPagos = collect([
                [
                'idestadopago' => $estadospagos->idestadopago,
                'nomestado' => $estadospagos->nomestado,
                ]
            ]);
                break;
        }
        return response()->json($coleccionEstadosPagos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
