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
                throw new Exception("Error al crear el estado pago", 101);
            }
            $response['type'] = 'success';
            $response['title'] = 'Creacion del Estado Pago';
            $response['msg'] = 'Se creo el estado pago con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al crear el estado pago';
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

    public function list(){

        $selectCampos = [
            'idestadopago',
            'nomestado'
        ];

        $estadopago = estadoPago::select($selectCampos)->paginate(10);


        return response()->json($estadopago);
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
        try {
            $actualizarEstadoPago = estadoPago::findOrFail($id);
            $actualizarEstadoPago -> nomestado = $request -> nomestado;

            if(!$actualizarEstadoPago->update()){
                throw new Exception("Error al actualizar el estado pago", 101);
            }
            $response['type'] = 'success';
            $response['title'] = 'Actualización del estado pago';
            $response['msg'] = 'Se actualizo el estado pago con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al actualizar el estado pago';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        }
        
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $estadopago = estadoPago::findOrFail($id);
            if (!$estadopago->delete()) {
                throw new Exception("Error al eliminar el estado pago", 101);
            }
            $response['type'] = 'success';
            $response['title'] = 'Eliminar estado pago';
            $response['msg'] = 'Se elimino el estado pago con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al eliminar el estado pago';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();

            if ($e->getCode() == 23000) {
                $response['msg'] = "El Estado Pago se encuentra asociado, no se puede eliminar";
            }

        }
        

        return response()->json($response);
    }
}
