<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $result = Profiles::all();

        $profiles = [];

        foreach ($result as $key => $profile) {
            $profiles[$key] = $profile;

            $profiles[$key]['users'] = Profiles::find($profile->id)->users;
        }

        return response()->json($profiles, 200);
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
        $profile = new Profiles;

        $profile->name = $request->name;
        $profile->type = $request->type;
        $profile->active = $request->active;

        $profile->save();

        return response($profile);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function show(Profiles $profiles)
    {
        $result = $profiles::find($id);

        return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function edit(Profiles $profiles)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profiles $profiles)
    {
        $profile = $profiles::find($id);

        $profile->name = $request->name;
        $profile->type = $request->type;
        $profile->active = $request->active;

        if($profile->save()){
            return response()->json($profile, 200);
        }else{
            return response()->json([
                'message' => 'Erro ao Editar o Consultorio {$request->nome}!'
            ], 202);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profiles $profiles)
    {
        $profile = $profiles::find($id);

        if(isset($profile)) {
            if ($profile->delete()) {
                return response()->json([
                    'message' => 'Deletado o Perfil {$consultorio->nome}!'
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
