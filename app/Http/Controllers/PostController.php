<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


//Controlador de publicacion
class PostController extends Controller
{
    public function __construct()
    {                           //se permite acceso sin autentificacion esto metodos
       $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user){ //Envia a la pag de inicio de perfil
        //dd('Desde muro..');
        //dd(auth()->user());
        //dd($user->username);

        //Va a la tabla Post y busca el user_id
                                                //simplePaginate
        $posts= Post::where('user_id', $user->id)->paginate(2);

        //retornar a la pag
        return view('dashboard', [ //lo que ingrese aqui accede en la vista
            'user'=> $user,

            //nuevo:
            'posts'=> $posts
        ]);
    }

    public function create()
    {
                    //carpeta.archivo
        return view('posts.create');
    }

    public function store(Request $request)
    {
      //dd('Creando formulario');   
      $this->validate( $request, [
       
            //crea msjs de requerido
            'titulo'=>'required|max:225',
            'descripcion'=>'required',
            'imagen'=>'required'

        ]);

        //Al modelo
/*         Post::create([

            'titulo'=>$request->titulo,
            'descripcion'=> $request->descripcion,
            'imagen'=> $request->imagen,
                        //envia id del usuario autenticado
            'user_id'=> auth()->user()->id
        ]);
 */
        //Otra forma de crear registros

/*         $post = new Post;
        $post->titulo =  $request->titulo;
        $post->descripcion =  $request->descripcion;
        $post->imagen =  $request->imagen;
        $post->user_id = auth()->user()->id;

        $post->save(); */
 
        //Otra forma
        
                        //posts of class modelo User
        $request->user()->posts()->create([
            'titulo'=>$request->titulo,
            'descripcion'=> $request->descripcion,
            'imagen'=> $request->imagen,
                        //envia id del usuario autenticado
            'user_id'=> auth()->user()->id
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }

    //Metodos de view defino mis variables para usar en la VISTA
    public function show(User $user, Post $post)
    {
        return view ('posts.show',[
            'user'=> $user,
            'post'=>$post
        ]
    
    );
    }
}
