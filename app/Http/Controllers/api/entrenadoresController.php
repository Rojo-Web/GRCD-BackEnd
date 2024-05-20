<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\entrenador;
use \Illuminate\Support\Facades\Validator;

class entrenadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $entrenadores = entrenador::all();
        return json_encode(['entrenadores' => $entrenadores]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nombre'=> ['required'],
            'apellido'=> ['required'],
            'especialidad'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $entrenador = new entrenador();
        $entrenador->nombre = $request->nombre;
        $entrenador->apellido = $request->apellido;
        $entrenador->especialidad = $request->especialidad;
        $entrenador->id = $request->id;
        $entrenador->save();
        return json_encode(['entrenador' => $entrenador,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $entrenador = entrenador::find($id);
        if (is_null($entrenador)){
            return abort(404);
        }
        return json_encode(['entrenador' => $entrenador]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $entrenador = entrenador::find($id);
        if (is_null($entrenador)){
            return abort(404);
        }
        $validate = Validator::make($request->all(),[
            'nombre'=> ['required'],
            'apellido'=> ['required'],
            'especialidad'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $entrenador->nombre = $request->nombre;
        $entrenador->apellido = $request->apellido;
        $entrenador->especialidad = $request->especialidad;
        $entrenador->save();
        return json_encode(['entrenador' => $entrenador,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $entrenador = entrenador::find($id);
        if (is_null($entrenador)){
            return abort(404);
        }
        $entrenador->delete();
        return json_encode(['entrenador' => $entrenador,'success'=>true]);
    }
}
