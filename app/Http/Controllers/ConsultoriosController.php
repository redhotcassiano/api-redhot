<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Consultorios;
use App\Models\Consultas;
use Illuminate\Http\Request;

class ConsultoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Consultorios::all();

        $arrConsultorios = Consultorios::all();

        $listConsultorios = [];

        foreach ($arrConsultorios as $key => $consultorio) {
            $listConsultorios[$key] = $consultorio;

            $arrConsultas = Consultorios::find($consultorio->id)->consultas;

            $listConsultas = [];

            foreach ($arrConsultas as $key => $consulta) {
                $listConsultas[$key] = $consulta;
                $listConsultas[$key]['cliente'] = Consultas::find($consulta->id)->client;
                $listConsultas[$key]['doctor'] = Consultas::find($consulta->id)->doctor;
            }

            $consultas = collect($listConsultas);
            $listConsultorios[$key]['consultas'] = $consultas->all();
        }

        $consultorios = collect($listConsultorios);

        return response()->json($consultorios->all(), 200);
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
        $consultorio = new Consultorios;

        $user = User::find($request->user_id);

        if (isset($user->id)) {
            $consultorio->nome = $request->nome;
            $consultorio->razao_social = $request->razao_social;
            $consultorio->active = $request->active;
            $consultorio->user_id = $user->id;

            $consultorio->save();

            return response($consultorio);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultorios  $consultorios
     * @return \Illuminate\Http\Response
     */
    public function show(Consultorios $consultorios, $id)
    {
        $result = $consultorios::find($id);

        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consultorios  $consultorios
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultorios $consultorios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consultorios  $consultorios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consultorios $consultorios, $id)
    {
        $consultorio = $consultorios::find($id);

        $consultorio->nome = $request->nome;
        $consultorio->razao_social = $request->razao_social;
        $consultorio->active = $request->active;

        if($consultorio->save()){
            return response()->json($consultorio, 200);
        }else{
            return response()->json([
                'message' => 'Erro ao Editar o Consultorio {$request->nome}!'
            ], 202);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consultorios  $consultorios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultorios $consultorios, $id)
    {
        $consultorio = $consultorios::find($id);

        if(isset($consultorio)) {
            if ($consultorio->delete()) {
                return response()->json([
                    'message' => 'Deletado o Consultorio {$consultorio->nome}!'
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Erro ao Deletar o Consultorio {$consultorio->nome}!'
                ], 202);
            }
        }else{
            return response()->json([
                'message' => 'Não Existe esse Consultorio!'
            ], 202);
        }
    }
}
