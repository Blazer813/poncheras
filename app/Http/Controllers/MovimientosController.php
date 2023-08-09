<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\movimiento;
use Exception;

class MovimientosController extends Controller
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
        $user = auth()->user();
        $response = [];
        try {
            $nuevoMovimiento = new movimiento();
            $nuevoMovimiento->fcmovimiento = $request->fcmovimiento;
            $nuevoMovimiento->idcolaborador = $request->idcolaborador;
            $nuevoMovimiento->id = $user->id;
            $nuevoMovimiento->descripcion = $request->descripcion;

            $nuevoMovimiento->idponches = $request->idponches;
            $nuevoMovimiento->valordeuda = $request->valordeuda;
            $nuevoMovimiento->valorabono = $request->valorabono;
            $nuevoMovimiento->idestadopago = $request->idestadopago;
            $nuevoMovimiento->fcpago = $request->fcpago;
            $nuevoMovimiento->idestado = $request->idestado;
            $nuevoMovimiento->detanulacion = $request->detanulacion;
            $nuevoMovimiento->fcanulacion = $request->fcanulacion;

            if (!$nuevoMovimiento->save()) {
                throw new Exception("Error al crear el movimiento", 101);
            }
            $response['type'] = 'success';
            $response['title'] = 'Creacion de movimiento';
            $response['msg'] = 'Se creo el movimiento con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al crear el movimiento';
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
            'idmovimiento',
            'fcmovimiento',
            'idcolaborador',
            'id',
            'descripcion',
            'evidencia',
            'idponches',
            'valordeuda',
            'valorabono',
            'idestadopago',
            'fcpago',
            'idestado',
            'detanulacion',
            'fcanulacion',
        ];
        $relacionMovimientos = [
            'colaborador:idcolaborador,nombrecompleto',
            'User:id,name',
            'tipoPonchera:idponches,nombreponche,valor',
            'estadoPago',
            'estado',
        ];

        $coleccionMovimientos = collect([]);

        switch ($id) {
            case '@':
                $movimientos = movimiento::select($selectCampos)->with($relacionMovimientos)->get();
                foreach ($movimientos as $key => $value) {
                    $coleccionAux = collect([
                        [
                            'it' => $key + 1,
                            'idmovimiento' => $value->idmovimiento,
                            'fcmovimiento' => $value->fcmovimiento,
                            'colaborador' => $value->colaborador,
                            'causante' => $value->User,
                            'descripcion' => $value->descripcion,
                            'evidencia' => $value->evidencia,
                            'tipoPonchera' => $value->tipoPonchera,
                            'valordeuda' => $value->valordeuda,
                            'valorabono' => $value->valorabono,
                            'estadoPago' => $value->estadoPago,
                            'fcPago' => $value->fcpago,
                            'estado' => $value->estado,
                            'detanulacion' => $value->detanulacion,
                            'fcanulacion' => $value->fcanulacion,
                        ]
                    ]);
                    $coleccionMovimientos = $coleccionAux->concat($coleccionMovimientos);
                    # code...
                }
                break;
            
            default:
                $movimientos = movimiento::select($selectCampos)->where('idmovimiento', $id)->with($relacionMovimientos)->first();
                $coleccionMovimientos = collect([
                    [
                        'idmovimiento' => $movimientos->idmovimiento,
                        'fcmovimiento' => $movimientos->fcmovimiento,
                        'colaborador' => $movimientos->colaborador,
                        'causante' => $movimientos->User,
                        'descripcion' => $movimientos->descripcion,
                        'evidencia' => $movimientos->evidencia,
                        'tipoPonchera' => $movimientos->tipoPonchera,
                        'valordeuda' => $movimientos->valordeuda,
                        'valorabono' => $movimientos->valorabono,
                        'estadoPago' => $movimientos->estadoPago,
                        'fcPago' => $movimientos->fcpago,
                        'estado' => $movimientos->estado,
                        'detanulacion' => $movimientos->detanulacion,
                        'fcanulacion' => $movimientos->fcanulacion,
                    ]
                ]);
                break;
        }
        return response()->json($coleccionMovimientos);
    }


    public function list(){

        $selectCampos = [
            'idmovimiento',
            'fcmovimiento',
            'idcolaborador',
            'id',
            'descripcion',
            'evidencia',
            'idponches',
            'valordeuda',
            'valorabono',
            'idestadopago',
            'fcpago',
            'idestado',
            'detanulacion',
            'fcanulacion',
        ];
        $relacionMovimientos = [
            'colaborador:idcolaborador,nombrecompleto',
            'User:id,name',
            'tipoPonchera:idponches,nombreponche,valor',
            'estadoPago',
            'estado',
        ];

        $movimientos = movimiento::select($selectCampos)->with($relacionMovimientos)->paginate(8);
        

        return response()->json($movimientos);
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
        $response = [];
        try {
            $actualizarMovimiento = movimiento::findOrFail($id);
            $actualizarMovimiento->fcmovimiento = $request->fcmovimiento;
            $actualizarMovimiento->idcolaborador = $request->idcolaborador;
            $actualizarMovimiento->descripcion = $request->descripcion;
            $actualizarMovimiento->evidencia = $request->evidencia;
            $actualizarMovimiento->idponches = $request->idponches;
            $actualizarMovimiento->valordeuda = $request->valordeuda;
            $actualizarMovimiento->valorabono = $request->valorabono;
            $actualizarMovimiento->idestadopago = $request->idestadopago;
            $actualizarMovimiento->fcpago = $request->fcpago;
            $actualizarMovimiento->idestado = $request->idestado;
            $actualizarMovimiento->detanulacion = $request->detanulacion;
            $actualizarMovimiento->fcanulacion = $request->fcanulacion;

            if(!$actualizarMovimiento->update()){
                throw new Exception("Error al actualizar el movimiento", 101);
            }
            $response['type'] = 'Success';
            $response['title'] = 'Actualización del movimiento';
            $response['msg'] = 'Se actualizo el movimiento con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al actualizar el movimiento';
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
        $response = [];
        try {
            $movimiento = movimiento::findOrFail($id);
            if(!$movimiento->delete()){
                throw new Exception("Error al eliminar el movimiento", 101);
            };
            $response['type'] = 'Success';
            $response['title'] = 'ELiminar movimiento';
            $response['msg'] = 'Se elimino el movimiento con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al eliminar el movimiento';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        }

        return response()->json($response);
    }
}
