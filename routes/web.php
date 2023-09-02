<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HelloController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;


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

// Route::get('hello', function(){
//     $ping = ['ping' => "pong"];
//     return $ping; //jika menggunakan echo daripada return, maka gak bisa nerima/mengembalikan array dan dapat membuat conflict syntax (syntax dari dua file view akan tergabung secara kacau)
// });
// Route::get('hello', 'App\Http\Controllers\HelloController@index');
// Route::get('hello', [HelloController::class, 'index']);
// Route::get('world', [HelloController::class, 'world_message']);
// Route::resource('posts', PostController::class);

Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'authentication']);
Route::get('logout', [AuthController::class, 'logout']);
Route::get('register', [Authcontroller::class, 'register_form']);
Route::post('register', [AuthController::class, 'register']);

Route::get('posts', [PostController::class, 'index']);
Route::get('posts/create', [PostController::class, 'create']);
Route::get('posts/{id}', [PostController::class, 'show']);
Route::post('posts', [PostController::class, 'store']);
Route::get('posts/{id}/edit', [PostController::class, 'edit']);
Route::patch('posts/{id}', [PostController::class, 'update']);
Route::delete('posts/{id}', [PostController::class, 'destroy']);