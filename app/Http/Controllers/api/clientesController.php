<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cliente;
use \Illuminate\Support\Facades\Validator;

class clientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = cliente::all();
        return json_encode(['clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'nombre'=> ['required'],
            'apellido'=> ['required'],
            'telefono'=> ['required'],
            'email'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $cliente = new cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->id = $request->id;
        $cliente->save();
        return json_encode(['cliente' => $cliente,'success'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = cliente::find($id);
        if (is_null($cliente)){
            return abort(404);
        }
        return json_encode(['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = cliente::find($id);
        if (is_null($cliente)){
            return abort(404);
        }
        $validate = Validator::make($request->all(),[
            'nombre'=> ['required'],
            'apellido'=> ['required'],
            'telefono'=> ['required'],
            'email'=> ['required'],

        ]);

        if($validate->fails()){
            return response()->json([
                'msg'=> 'Se produjo un error en la validacion de la informacion ',
                'statusCode'=> 400
            ]);
        }
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->email = $request->email;
        $cliente->save();
        return json_encode(['cliente' => $cliente,'success'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = cliente::find($id);
        if (is_null($cliente)){
            return abort(404);
        }
        $cliente->delete();
        return json_encode(['cliente' => $cliente,'success'=>true]);
    }
}
