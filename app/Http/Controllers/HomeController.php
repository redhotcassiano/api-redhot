<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*
            tipos de ACL
            SADM = Super Admin;
            ADM = Adimin;
            PR = Proprietario;
            PF = Profissional;
            CL = Cliente;
        */
        if(Auth::user()->type_acl == "SADM") {
            return view('home_adm');
        }

        return view('home');


    }
}
