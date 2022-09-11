<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request){
        $imagen = $request->file('file');
                //id unico para las imagenes
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000,1000);//fio tamaño

        $imagenPath= public_path('uploads') . '/' . $nombreImagen; //creo ruta y nueva carpeta
        $imagenServidor->save($imagenPath); //guardo

        return response()->json(['imagen'=> $nombreImagen]);
    }
}
