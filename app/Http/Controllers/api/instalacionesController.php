<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\instalacion;
use \Illuminate\Support\Facades\Validator;

class instalacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instalaciones = instalacion::all();
        return json_encode(['instalaciones' => $instalaciones]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nombre'=> ['required'],
            'tipo'=> ['required'],
            'capacidad'=> ['required','min:10'],
            'disponibilidad'=> ['required'],
        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $instalacion = new instalacion();
        $instalacion->nombre = $request->nombre;
        $instalacion->tipo = $request->tipo;
        $instalacion->capacidad = intval($request->capacidad);
        $instalacion->disponibilidad = $request->disponibilidad;
        $instalacion->id = $request->id;
        $instalacion->save();
        return json_encode(['instalacion' => $instalacion,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $instalacion = instalacion::find($id);
        if (is_null($instalacion)){
            return abort(404);
        }
        return json_encode(['instalacion' => $instalacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $instalacion = instalacion::find($id);
        if (is_null($instalacion)){
            return abort(404);
        }
        $instalacion->nombre = $request->nombre;
        $instalacion->tipo = $request->tipo;
        $instalacion->capacidad = intval($request->capacidad);
        $instalacion->disponibilidad = $request->disponibilidad;
        $instalacion->save();
        return json_encode(['instalacion' => $instalacion,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instalacion = instalacion::find($id);
        if (is_null($instalacion)){
            return abort(404);
        }
        $instalacion = instalacion::find($id);
        $instalacion->delete();
        return json_encode(['instalacion' => $instalacion,'success'=>true]);
    }
}
