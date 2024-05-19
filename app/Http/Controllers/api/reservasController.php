<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\reserva;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class reservasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = DB::table('reservas')
            ->join('instalaciones', 'reservas.instalacion_id', '=', 'instalaciones.id')
            ->join('clientes', 'reservas.cliente_id', '=', 'clientes.id')
            ->select('reservas.*', 'clientes.nombre as cliente_nombre', 'instalaciones.nombre as instalaciones_nombre', 'clientes.apellido as clientes_apellido')
            ->get();
            return json_encode(['reservas' => $reservas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'instalacion_id'=> ['required','integer'],
            'cliente_id'=> ['required','integer'],
            'fecha_hora_inicio'=> ['required'],
            'fecha_hora_final'=> ['required'],
            'estado'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $reserva = new reserva();
        $reserva->instalacion_id = $request->instalacion_id;
        $reserva->cliente_id = $request->cliente_id;
        $reserva->fecha_hora_inicio = $request->fecha_hora_inicio;
        $reserva->fecha_hora_final = $request->fecha_hora_final;
        $reserva->estado = $request->estado;
        $reserva->id = $request->id;
        $reserva->save();
        return json_encode(['reserva' => $reserva,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reserva = reserva::find($id);
        if (is_null($reserva)){
            return abort(404);
        }

        $instalaciones = DB::table('instalaciones')
            ->orderBy('nombre')
            ->get();
        $clientes = DB::table('clientes')
            ->orderBy('nombre')
            ->get();
        return json_encode(['reserva' => $reserva,"instalaciones" => $instalaciones,"clientes" => $clientes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $reserva = reserva::find($id);
        if (is_null($reserva)){
            return abort(404);
        }
        $reserva->instalacion_id = $request->instalacion_id;
        $reserva->cliente_id = $request->cliente_id;
        $reserva->fecha_hora_inicio = $request->fecha_hora_inicio;
        $reserva->fecha_hora_final = $request->fecha_hora_final;
        $reserva->estado = $request->estado;
        $reserva->save();
        return json_encode(['reserva' => $reserva,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reserva = reserva::find($id);
        if (is_null($reserva)){
            return abort(404);
        }
        $reserva->delete();
        return json_encode(['reserva' => $reserva,'success'=>true]);
    }
}
