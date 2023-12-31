<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\colaborador;
use Exception;


class ColaboradoresController extends Controller
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
            $nuevocolaborador = new colaborador();
            $nuevocolaborador->nombrecompleto = $request->nombrecompleto;
            $nuevocolaborador->telefono = $request->telefono;
            $nuevocolaborador->correo = $request->correo;
            $nuevocolaborador->fcnacimiento = $request->fcnacimiento;

            if(!$nuevocolaborador->save()){
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
        $selecCampos = [
            'idcolaborador',
            'nombrecompleto',
            'telefono',
            'correo',
            'fcnacimiento'
        ];

        $coleccionColaboradores = collect([]);

        switch($id) {
            case '@':
                $colaboradores = colaborador::select($selecCampos)->get();
                foreach ($colaboradores as $key => $value){
                    $coleccionAux = collect([
                        [
                            'it' => $key + 1,
                            'idcolaborador' => $value->idcolaborador,
                            'nombrecompleto' => $value->nombrecompleto,
                            'telefono' => $value->telefono,
                            'correo' => $value->correo,
                            'fcnacimiento' => $value->fcnacimiento,
                        ]
                    ]);
                    $coleccionColaboradores = $coleccionAux->concat($coleccionColaboradores);
                }
                break;

            default:
            $colaboradores = colaborador::select($selecCampos)->where('idcolaborador', $id)->first();   
            $coleccionColaboradores = collect([
                [
                    'idcolaborador' => $colaboradores->idcolaborador,
                    'nombrecompleto' => $colaboradores->nombrecompleto,
                    'telefono' => $colaboradores->telefono,
                    'correo' => $colaboradores->correo,
                    'fcnacimiento' => $colaboradores->fcnacimiento
                ]
            ]);
            break;
        }
        return response()->json($coleccionColaboradores);
    
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
