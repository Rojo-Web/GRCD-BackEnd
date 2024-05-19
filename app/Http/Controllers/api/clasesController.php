<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\clase;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class clasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clases = DB::table('clases')
            ->join('instalaciones', 'clases.instalacion_id', '=', 'instalaciones.id')
            ->join('entrenadores', 'clases.entrenador_id', '=', 'entrenadores.id')
            ->select('clases.*', 'entrenadores.nombre as entrenadore_nombre', 'instalaciones.nombre as instalaciones_nombre', 'entrenadores.apellido as entrenadore_apellido')
            ->get();
            return json_encode(['clases' => $clases]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nombre'=> ['required'],
            'descripcion'=> ['required'],
            'instalacion_id'=> ['required','number'],
            'entrenador_id'=> ['required','number'],
            'hora_inicio'=> ['required'],
            'duracion'=> ['required','number'],
        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $clase = new clase();
        $clase->instalacion_id = $request->instalacion_id;
        $clase->entrenador_id = $request->entrenador_id;
        $clase->hora_inicio = $request->hora_inicio;
        $clase->duracion = $request->duracion;
        $clase->nombre = $request->nombre;
        $clase->descripcion = $request->descripcion;
        $clase->id = $request->id;
        $clase->save();
        return json_encode(['clase' => $clase,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $clase = clase::find($id);
        if (is_null($clase)){
            return abort(404);
        }

        $instalaciones = DB::table('instalaciones')
            ->orderBy('nombre')
            ->get();
        $entrenadores = DB::table('entrenadores')
            ->orderBy('nombre')
            ->get();
        return json_encode(['clase' => $clase,"instalaciones" => $instalaciones,"entrenadores" => $entrenadores]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $clase = clase::find($id);
        if (is_null($clase)){
            return abort(404);
        }
        $clase->instalacion_id = $request->instalacion_id;
        $clase->entrenador_id = $request->entrenador_id;
        $clase->hora_inicio = $request->hora_inicio;
        $clase->duracion = $request->duracion;
        $clase->nombre = $request->nombre;
        $clase->descripcion = $request->descripcion;
        $clase->save();
        return json_encode(['clase' => $clase,'success'=>true]); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clase = clase::find($id);
        if (is_null($clase)){
            return abort(404);
        }
        $clase->delete();
        return json_encode(['clase' => $clase,'success'=>true]);
    }
}
