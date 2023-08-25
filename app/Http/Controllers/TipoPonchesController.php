<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tiposPonchera;
use Exception;

class TipoPonchesController extends Controller
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
            $nuevoPonches = new tiposPonchera();
            $nuevoPonches->nombreponche = $request->nombreponche;   
            $nuevoPonches->valor = $request->valor;

            if(!$nuevoPonches->save()) {
                throw new Exception("error al crear tipo de poncheras", 101);

            }
                $response['type'] = 'success';
                $response['title'] = 'creacion del tipo de poncheras';
                $response['msg'] = 'se creo el tipo de poncheras con exito';


    } catch (Exception $e) {
        $response['Linea'] = $e->getLine();
        $response['archivo'] = $e->getFile();
        $response['type'] = 'error';
        $response['title'] = 'error al crear tipo de poncheras';
        $response['error_code']-> $e->getMessage();

    
    }  
    return response()->json($response);

}
    
    public function show(string $id)
    {
        $response = [];
        $selectCampos = [
            'idponches',
            'nombreponche',
            'valor',
        ];

        $coleccionTiposPonchera = collect([]);

        switch ($id) {
            case '@':
            $tiposPonchera = tiposPonchera::select($selectCampos)->get();
            foreach ($tiposPonchera as $key => $value) {
                $colleccionAux = collect([
                    [
                        'it' => $key + 1,
                        'idponches' => $value->idponches,
                        'nombreponche' => $value->nombreponche,
                        'valor' => $value->valor
                    ]
                ]);
                $coleccionTiposPonchera = $colleccionAux->concat($coleccionTiposPonchera);
            }
            break;
            
        default: 
            $tiposPonchera = tiposPonchera::select($selectCampos)->where('idponches',$id)->first();
            $coleccionTiposPonchera  = collect([
                [
                    'idponches' => $tiposPonchera->idponches,
                    'nombreponche' => $tiposPonchera->nombreponche,
                    'valor' => $tiposPonchera->valor
                ]
            ]); 
        }
        return response()->json($coleccionTiposPonchera);

    }
    
    public function list(){

        $selectCampos = [
            'idponches',
            'nombreponche',
            'valor',            
        ];

        $tiposPonchera = tiposPonchera::select($selectCampos)->paginate(10);
        

        return response()->json($tiposPonchera);
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
            $actualizarTipoPonche = tiposPonchera::findOrFail($id);
            $actualizarTipoPonche->nombreponche = $request->nombreponche;
            $actualizarTipoPonche->valor = $request->valor;
            
            if(!$actualizarTipoPonche->update()){
                throw new Exception("Error al actualizar el Tipo de Ponchera", 101);
            }
            $response['type'] = 'success';
            $response['title'] = 'Actualización del Tipo de Ponchera';
            $response['msg'] = 'Se actualizo el Tipo de Ponchera con exito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al actualizar el Tipo de Ponchera';
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
            $tiposPonchera = TiposPonchera::findOrFail($id);
            if (!$tiposPonchera->delete()) {
                throw new Exception("Error al eliminar el Tipo de Ponchera", 101);
            }
        
            $response['type'] = 'success';
            $response['title'] = 'Eliminar Tipo de Ponchera';
            $response['msg'] = 'Se eliminó el Tipo de Ponchera con éxito';
        } catch (Exception $e) {
            $response['Linea'] = $e->getLine();
            $response['archivo'] = $e->getFile();
            $response['type'] = 'error';
            $response['title'] = 'Error al eliminar el Tipo de Ponchera';
            $response['error_code'] = $e->getCode();
            $response['msg'] = $e->getMessage();
        
            if ($e->getCode() == 23000) {
                $response['msg'] = "El Tipo de Ponchera se encuentra asociado, no se puede eliminar.";
            }
        }
        
        return response()->json($response);
        
    }
}