<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Consultorios;
use App\Models\Consultas;
use Illuminate\Http\Request;

class ConsultasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrConsultas = Consultas::all();

        $listConsultas = [];

        foreach ($arrConsultas as $key => $consulta) {
            $listConsultas[$key] = $consulta;
            $listConsultas[$key]['cliente'] = Consultas::find($consulta->id)->client;
            $listConsultas[$key]['doctor'] = Consultas::find($consulta->id)->doctor;
            $listConsultas[$key]['consultorio'] = Consultas::find($consulta->id)->consultorio;
        }

        $consultas = collect($listConsultas);

        return response()->json($consultas->all(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consulta = new Consultas;

        $consultorio = Consultorios::find($request->consultorios_id);
        $client = User::find($request->client_id);
        $doctor = User::find($request->doctor_id);

        if (isset($client->id)) {
            $consulta->description = $request->description;
            $consulta->data_consulta = $request->data_consulta;
            $consulta->hora_consulta = $request->hora_consulta;
            $consulta->active = $request->active;
            $consulta->consultorios_id = $consultorio->id;
            $consulta->client_id = $client->id;
            $consulta->doctor_id = $doctor->id;

            $consulta->save();

            return response($consulta);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultas  $consultas
     * @return \Illuminate\Http\Response
     */
    public function show(Consultas $consultas, $id)
    {
        if(!empty($consultas::find($id))) {
            $result = $consultas::find($id);
            $result['cliente'] = $consultas::find($result->id)->client;
            $result['doctor'] = $consultas::find($result->id)->doctor;
            $result['consultorio'] = $consultas::find($result->id)->consultorio;

            return response()->json($result, 200);
        }else{
            return response()->json([
                'message' => 'Não Existe essa Consulta no Sistema.'
            ], 200);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultas  $consultas
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultas $consultas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultas  $consultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultas $consultas, $id)
    {
        $consulta = $consultas::find($id);

        $consulta->description = $request->description;
        $consulta->data_consulta = $request->data_consulta;
        $consulta->hora_consulta = $request->hora_consulta;
        $consulta->active = $request->active;
        $consulta->consultorios_id = $consultorio->id;
        $consulta->client_id = $client->id;
        $consulta->doctor_id = $doctor->id;

        if($consulta->save()){
            return response()->json($consulta, 200);
        }else{
            return response()->json([
                'message' => 'Erro ao Editar a Consulta '.$consulta->id.'!'
            ], 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultas  $consultas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultas $consultas, $id)
    {
        $consulta = $consultas::find($id);

        if(isset($user)) {
            if ($user->delete()) {
                return response()->json([
                    'message' => 'Deletado a Consulta '.$consulta->descption.'!'
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Erro ao Deletar a Consulta!'
                ], 202);
            }
        }else{
            return response()->json([
                'message' => 'Não Existe essa Consulta!'
            ], 202);
        }
    }
}
