<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\movimiento;
use Exception;
use DB;

class ContabilidadController extends Controller
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
        //
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

        $response = [];
        try {
            $consulta = DB::table('movimientos as m')
            ->select(
                'm.idcolaborador', 
                'c.nombrecompleto', 
                'c.fcnacimiento',
                DB::raw('SUM(m.valordeuda) AS total_deuda'), 
                DB::raw('SUM(m.valorabono) AS total_abono'),
                DB::raw('SUM(m.valordeuda - m.valorabono) AS saldo')
            )
            ->join('colaboradors as c', 'm.idcolaborador', '=', 'c.idcolaborador')
            ->groupBy('m.idcolaborador', 'c.nombrecompleto', 'c.fcnacimiento')
            ->paginate(10);

        return $consulta;
        

        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al crear el colaborador';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();

            return response()->json($response);
        }


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

        $movimientos = movimiento::select($selectCampos)->with($relacionMovimientos)->paginate(10);
        

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


