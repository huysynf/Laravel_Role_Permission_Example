<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    echo "helo";
//    return view('welcome');
});


Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/',  'index');
    Route::get('/{id}',  'show');
    Route::get('/create',  'create');
    Route::post('/', 'store');
    Route::get('/{id}/edit',  'edit');
    Route::put('/{id}/update', 'update');
    Route::delete('/{id}',  'destroy');
});

Route::scopeBindings()->group(function (){
    Route::get('users/{user}/posts/{post}', function (\App\Models\User $user, \App\Models\Post $post){
        return $post;
    });
});

//Route::get('users/{user}/posts/{post}', function (\App\Models\User $user, \App\Models\Post $post){
//   return $post;
//})->scopeBindings();
