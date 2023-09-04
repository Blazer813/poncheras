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
            $response['type'] = 'success';
            $response['title'] = 'Creacion del colaborador';
            $response['msg'] = 'Se creo el colaborador con exito';
        } catch (Exception $e) {
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

    public function list(){

        $selectCampos = [
            'idcolaborador',
            'nombrecompleto',
            'telefono',
            'correo',
            'fcnacimiento',
        ];

        $colaborador = colaborador::select($selectCampos)->paginate(10);
        

        return response()->json($colaborador);
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
            $actualizarColaborador = colaborador::findOrFail($id);
            $actualizarColaborador->nombrecompleto = $request->nombrecompleto;
            $actualizarColaborador->telefono = $request->telefono;
            $actualizarColaborador->correo = $request->correo;
            $actualizarColaborador->fcnacimiento = $request->fcnacimiento;

            if(!$actualizarColaborador->update()){
                throw new Exception("Error al actualizar el colaborador", 101);
            }
            $response['type'] = 'success';
            $response['title'] = 'Actualización del colaborador';
            $response['msg'] = 'Se actualizo el colaborador con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al actualizar el colaborador';
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
            $colaborador = colaborador::findOrFail($id);
            if(!$colaborador->delete()){
                throw new Exception("Error al eliminar el colaborador", 101);
            }
            $response['type'] = 'success';
            $response['title'] = 'Eliminar colaborador';
            $response['msg'] = 'Se elimino el colaborador con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al eliminar el colaborador';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();

            if ($e->getCode() == 23000) {
                $response['msg'] = "El Colaborador se encuentra asociado, no se puede eliminar";
            }

        }
        

        return response()->json($response);
    }
}
