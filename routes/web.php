<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ComentarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('principal');
});

/*syntaxy de metodo, objeto.metodoEstatico.metodo*/       //renombras la URL
Route::get('/register', [RegisterController::class,'index'])->name('register'); 
Route::post('/register', [RegisterController::class,'store']);

//Route::get('/muro', [PostController::class,'index'])->name('post.index');
            //user:valorDatabBase


Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store']);

Route::post('/logout', [LogoutController::class,'store'])->name('logout');

//post => form-button submit
//get => a - hrf

//dashboard
Route::get('/{user:username}', [PostController::class,'index'])->name('post.index');
Route::get('/posts/create', [PostController::class,'create'])->name('post.create');
Route::post('/posts', [PostController::class,'store'])->name('posts.store');

//Ver publicacion
//Route::get('/posts/{post}', [PostController::class,'show'])->name('posts.show');
Route::get('/{user:username}/posts/{post}', [PostController::class,'show'])->name('posts.show');

//Guardar comentarios
Route::post('/{user:username}/posts/{post}', [ComentarioController::class,'store'])->name('comentarios.store');


Route::post('/imagenes',[ImagenController::class, 'store'])->name('imagenes.store');

