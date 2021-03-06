<?php

namespace App\Http\Controllers;

use App\Models\InfoConsultorios;
use App\Models\Consultorios;
use Illuminate\Http\Request;

class InfoConsultoriosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return InfoConsultorios::all();
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
        $infoConsultorio = new InfoConsultorios;

        $consultorio = Consultorios::find($request->consultorios_id);

        if (isset($consultorio->id)) {
            $infoConsultorio->name = $request->name;
            $infoConsultorio->description = $request->description;
            $infoConsultorio->consultorios_id = $consultorio->id;

            $infoConsultorio->save();

            return response($infoConsultorio);
        }else{
            return response()->json($consultorio, 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InfoConsultorios  $infoConsultorios
     * @return \Illuminate\Http\Response
     */
    public function show(InfoConsultorios $infoConsultorios)
    {
        $result = $infoConsultorios::find($id);

        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InfoConsultorios  $infoConsultorios
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoConsultorios $infoConsultorios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfoConsultorios  $infoConsultorios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfoConsultorios $infoConsultorios)
    {
        $infoConsultorio = $infoConsultorios::find($id);

        $infoConsultorio->name = $request->name;
        $infoConsultorio->description = $request->description;

        if($infoConsultorio->save()){
            return response()->json($infoConsultorio, 200);
        }else{
            return response()->json([
                'message' => 'Erro ao Editar o Consultorio {$request->nome}!'
            ], 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfoConsultorios  $infoConsultorios
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoConsultorios $infoConsultorios)
    {
        $infoConsultorio = $infoConsultorios::find($id);

        if(isset($infoConsultorio)) {
            if ($infoConsultorio->delete()) {
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
