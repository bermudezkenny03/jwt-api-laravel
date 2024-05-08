<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return response()->json($pacientes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[
            'dni' => 'required|string|min:1|max:45',
            'nombre' => 'required|string|min:1|max:255',
            'direccion' => 'required|string|min:1|max:255',
            'codigoPostal' => 'required|string|max:45',
            'telefono' => 'required|max:20',
            'correo' => 'required|email|max:255'
        ];

        $validator = \Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $paciente = new Paciente($request->input());
        $paciente->save();
        return response()->json([
            'status' => true,
            'message' => 'Paciente creado exitosamente'
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        return response()->json(['status' => true, 'data' => $paciente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $rules =[
            'dni' => 'required|string|min:1|max:45',
            'nombre' => 'required|string|min:1|max:255',
            'direccion' => 'required|string|min:1|max:255',
            'codigoPostal' => 'required|string|max:45',
            'telefono' => 'required|max:20',
            'correo' => 'required|email|max:255'
        ];

        $validator = \Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $paciente->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Paciente actualizado exitosamente'
        ],200);    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return response()->json([
            'status' => true,
            'message' => 'Paciente eliminado exitosamente'
        ],200);
    }
}
