<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //informacion de base datos
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //Un post pertence a un USUARIO
    public function user(){
                                     //especifica solo la info. necesaria
        return $this->belongsTo(User::class)->select(['name','username']);
    }

    //Un post pertence a un USUARIO
    //Sin convenciones
    public function getUser(){
                                                        //especifica solo la info. necesaria
        return $this->belongsTo(User::class, 'user_id')->select(['name','username']);
    }

    public function getComentarios(){
        return $this->hasMany(Comentario::class);
    }
}
