<?php

use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
//login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');

//checagem
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/perfil/usuario', [ClienteController::class,'perfil'])->name('perfil.usuario');

Route::get('/info/fale', [MainController::class,'fale'])->name('info.fale');
Route::get('/info/sobre', [MainController::class,'sobre'])->name('info.sobre');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::post('/cadastro', [ClienteController::class,'inserir'])->name('cadastro.inserir');

Route::get('/perfil/editar', [ClienteController::class, 'editProfile'])->name('perfil.editar');
Route::post('/perfil/editar', [ClienteController::class, 'updateProfile'])->name('perfil.atualizar');

// web.php
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::delete('/perfil/usuario/delete/{id}', [ClienteController::class,'delete'])->name('delete');
Route::post('/favoritar', [ClienteController::class,'favoritar'])->name('favoritar');