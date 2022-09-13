@extends('layouts.app')

@section('titulo')
    {{$post->titulo}}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 p-5">
            <img src="{{ asset('uploads') . '/'. $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
        
            <div class="p-3">
                <p>0 likes</p>
            </div>
            <div>
                <!--user viene del modelo Post, llamas al metodo user()-->
                <p class="font-bold">{{$post->getUser->username}}</p>

                <p class="text-sm text-gray-500">   <!--Fecha-->
                    {{$post->created_at->diffForHumans()}}
                </p>
                <label class="text-gray-300 font-bold uppercase" for="ppDescripcion">Descripcion</label>
                <p id="ppDescripcion" class="mt-3">
                    {{$post->descripcion}}
                </p>
            </div>

        </div>
        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5" >
                @auth
                <p class="text-xl font-bold text-center mb-4">
                    Agrega un nuevo comentario
                </p>

                @if (session('mensaje'))
                    
                    <div class="bg-green-400 p-2 rounded mb-6 text-white text-center uppercase font-bold">
                        {{session('mensaje')}}
                    </div>
                    
                @endif
                <form action="{{ route('comentarios.store', ['post'=>$post,'user'=> $user]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Comentario
                        </label>
                        <textarea id="comentario" 
                                name="comentario" 
                               placeholder="Agrega un comentario"
                                class="border p-3 w-full rounded-lg 
                                @error('comentario')
                                    border-red-500
                                @enderror"
                        >
                        </textarea>
    
                        @error('comentario')
                            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2
                            text-center">{{$message}}</p>
                        @enderror
    
                    </div> 
                    <input type="submit"
                    value="Comentar"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer
                    uppercase font-bold w-full p-3 text-white rounded-lg"
                    /> 
                </form>
                @endauth

                <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10" >
                    @if ($post->getComentarios->count())
                        @foreach ($post->getComentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('post.index', $comentario->user) }}">
                                    {{$comentario->user->username}}
                                </a>
                                 <!--DATABASE-->
                                <p> {{$comentario->comentario}} </p>
                                   
                                <p class="text-sm text-gray-300 " > {{$comentario->created_at->diffForHumans()}}</p>
                               
                            </div>
                        @endforeach
                    @else
                        <p class="p-10 text-center">
                            No hay comentarios aun
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
