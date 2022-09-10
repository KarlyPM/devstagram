<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {   //1 prueba
       // dd('Autenticando..');
        
        //Recordando sesion
        //dd($request->remenber);


        //Validacion
        $this->validate( $request, [
            'email'=>'required|email',
            'password'=>'required'
        ]);
        
        
        if(!auth()->attempt($request->only('email','password'), $request->remenber)){
            return back()->with('mensaje','Credenciales incorrectas'); //Lo consumes en la vista
            //regresa a la pagina con el sgt msj
        }
        return redirect()->route('post.index', auth()->user()->username);
    }
}
