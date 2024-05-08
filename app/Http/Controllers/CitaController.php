<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use DB;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas = Cita::select('citas.*','pacientes.nombre as paciente')
        ->join('pacientes', 'pacientes.id', '=', 'citas.paciente_id')
        ->paginate(10);
        return response()->json($citas);
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'fecha' => 'required|date',
            'horaInicio' => 'required|time',
            'horaFin' => 'required|time',
            'estado' => 'required|string|max:50',
            'motivo' => 'required|string|min:50|max:255',
            'paciente_id' => 'required|numeric'
        ];

        $validator = \Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }

        $cita = new Cita($request->input());
        $cita->save();
        return response()->json([
            'status' => true,
            'message' => 'Cita creada exitosamente'
        ],200);       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show(Cita $cita)
    {
        return response()->json(['status' => true, 'data' => $cita]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cita $cita)
    {
        $rules = [
            'fecha' => 'required|date',
            'horaInicio' => 'required|time',
            'horaFin' => 'required|time',
            'estado' => 'required|string|max:50',
            'motivo' => 'required|string|min:50|max:255',
            'paciente_id' => 'required|numeric'
        ];

        $validator = \Validator::make($request->input(),$rules);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ],400);
        }
        $cita->update($request->input());
        return response()->json([
            'status' => true,
            'message' => 'Cita actualizada con éxito'
        ],200);     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cita $cita)
    {
        $cita->delete();
        return response()->json([
            'status' => true,
            'message' => 'Cita eliminada exitosamente'
        ],200);
    }
// Citas por paciente para mostrar cuantos pacientes
//hay y mostrar el nombre del paciente

public function CitasByPaciente(){
    $citas = Cita::select(DB::raw('count(citas.id) as count,
    pacientes.nombre'))
    ->rightJoin('pacientes','pacientes.id','=','citas.paciente_id')
    ->groupBy('pacientes.nombre')->get();
    return response()->json($citas);

}
public function all(){
    $citas = Cita::select('citas.*'
    ,'pacientes.nombre as paciente')
    ->join('pacientes','pacientes.id','=','citas.paciente_id')
    ->get();
    return response()->json($citas);
   }
}
