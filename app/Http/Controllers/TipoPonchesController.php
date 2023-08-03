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
            $nuevoPonches -> idponches = $request ->idtipoPonches;
            $nuevoPonches->nombrePonches = $request ->nombrePonches;   
            $nuevoPonches->valor = $request ->valor;

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
                        'nombrePonches' => $tiposPonchera->nombrePonches,
                        'valor' => $tiposPonchera->valor
                    ]
                ]); 
        }
        return response()->json($coleccionTiposPonchera);

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

