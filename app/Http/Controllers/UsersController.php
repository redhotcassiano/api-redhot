<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Consultorios;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = collect(User::all());

        return response()->json($users->all(), 200);
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'min:6'],
             'type_acl' => ['required', 'string']
        ]);

        if(isset($validatedData->message)){
            return response()->json($validatedData, 200);
        }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type_acl = $request->type_acl;

        $user->save();

        return response($user);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consultorios  $consultorios
     * @return \Illuminate\Http\Response
     */
    public function show(User $users, $id)
    {
        $result = $users::find($id);

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
     * @param  \App\User  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $users, $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type_acl' => ['required', 'string']
        ]);

        if(isset($validatedData->message)){
            return response()->json($validatedData, 200);
        }

        $user = $users::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->type_acl = $request->type_acl;

        if($user->save()){
            return response()->json($user, 200);
        }else{
            return response()->json([
                'message' => 'Erro ao Editar o user {$request->nome}!'
            ], 202);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $users, $id)
    {
        $user = $users::find($id);

        if(isset($user)) {
            if ($user->delete()) {
                return response()->json([
                    'message' => 'Deletado o Usuário $users->nome!'
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Erro ao Deletar o Usuário $users->nome!'
                ], 202);
            }
        }else{
            return response()->json([
                'message' => 'Não Existe esse Consultorio!'
            ], 202);
        }
    }
}
