<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index () /*Muestra el formulario */
    {
        return view('auth.register');
    }

    public function store (Request $request) /*Ingresa datos */
    {
        //dd('Post..');
        //dd($request->get('name'));
        $this->validate( $request, [

            //'name'=> ['required', min:5'], otra forma...
            'name'=> 'required|max:30',
            'username'=> 'required|unique:users|min:3|max:20',
            'email'=>'required|unique:users|email|max:60',
            'password'=>'required|confirmed|min:6'
        ]);

        //Modelo
        User::create([ //INSERT IN.....
            'name'=> $request->name,
            'username'=> Str::slug($request->username),
            'email'=> $request->email,
            'password'=> Hash::make($request->password) //Hash cifrando contraseña

        ]);
        //Autenticar el user
        auth()->attempt([
            'email'=> $request->email,
            'password'=> $request->password

        ]);
        //auth()->attempt($request->only('email','password'));


        //Redireccionar

        return redirect()->route('post.index', auth()->user()->username);
    }
}
