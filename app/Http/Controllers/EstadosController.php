<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\estado;
use Exception;



class EstadosController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $response = [];

        try {
            $nuevoestado = new estado();
            $nuevoestado->nomestado = $request->nomestado;
            $nuevoestado->color_fondo = $request->color_fondo;
            $nuevoestado->color_letras = $request->color_letras;

            if (!$nuevoestado->save()) {
                throw new Exception("error al crear estado", 101);
            }
            $response['type'] = 'success';
            $response['title'] = 'Creacion del estado';
            $response['msg'] = 'se creo el Estado  con exito';

        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['Archivo'] = $e->getFile();
            $response['type'] = 'Error';
            $response['title'] = 'Error al crear Estado'; 
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
            'idestado',
            'nomestado',
            'color_fondo',
            'color_letras'
        ];
        $coleccionEstados = collect([]);
        
        switch ($id) {
            case '@':
                $estado = estado::select($selectCampos)->get();
                foreach ($estado as $key => $value) {
                    $coleccionAux = collect([
                        [
                            'it' => $key + 1,
                            'idestado' => $value->idestado,
                            'nomestado' => $value->nomestado,
                            'color_fondo' => $value->color_fondo,
                            'color_letras' => $value->color_letras

                        ]
                        ]);
                        $coleccionEstados = $coleccionAux->concat($coleccionEstados);
                    }
                    break;
                default:
                    $estado = estado::select($selectCampos)->where('idestado',$id)->first();
                    $coleccionEstados = ([
                        [
                            'idestado' => $estado->idestado,
                            'nomestado' => $estado->nomestado,
                            'color_fondo' => $estado->color_fondo,
                            'color_letras' => $estado->color_letras,
                        ]
                        ]);
        }
        return response()->json($coleccionEstados);
    }

    public function list(){
        $selectCampos =[
         'idestado',
         'nomestado',
         'color_fondo',
         'color_letras'
        ];

        $estados = estado::select($selectCampos)->paginate(8);

        return response()->json($estados);
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
            $actualizarEstado = estado::findOrFail($id);
            $actualizarEstado->nomestado = $request->nomestado;
            $actualizarEstado->color_fondo = $request->color_fondo;
            $actualizarEstado->color_letras = $request->color_letras;

            if(!$actualizarEstado->update()){
                throw new Exception("Error al actualizar estado", 101);

                }

            $response['type'] = 'success';
            $response['title'] = 'Actualizacion del estado';
            $response['msg'] = 'Se actualizado el estado con exito';
        } catch (Exception $e) {
            $response['type'] = $e->getLine();
            $response['Archivo'] = $e->getFile();
            $response['type'] = 'Error';
            $response['title'] = 'Error al actualizar el estado';
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
    
      try{
        $estado = estado::findOrFail($id);
      if(!$estado->delete()){
        throw new Exception("Error al eliminar el estado", 101);
      };
      $response['type'] = 'success';
      $response['title'] = 'Eliminar Estado';
      $response['msg'] = 'se elimino el estado con exito';
      
      
        }catch(Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['Archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'error al eliminar el estado';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();

            if($e->getCode() == 23000){
                $response['msg'] = "El Estado se encuentra asociado, no se puede eliminar"
         ;}

            }

           
            return response()->json($response);


             
    }
}
