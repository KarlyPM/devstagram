<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    public function index(User $user){ //Envia a la pag de inicio de perfil
        //dd('Desde muro..');
        //dd(auth()->user());
        //dd($user->username);

        return view('dashboard', [
            'user'=> $user
        ]);
    }

    public function create()
    {
                    //carpeta.archivo
        return view('posts.create');
    }
}
