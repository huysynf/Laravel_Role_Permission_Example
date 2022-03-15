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
    return Blade::render('hello, {{$name}}', ['name' => 'DEHA ACADEMY']);
})->name('home');

Route::get('/to-home', function () {
    return to_route('home');
});



Route::controller(UserController::class)->prefix('users')->group(function () {
    Route::get('/',  'index')->middleware('check.role:admin|sup-admin'); // implode('|', $string)
    Route::get('/{id}',  'show')->middleware('check.permission:show-user');;
    Route::get('/create', 'create');
    Route::post('/', 'store');
    Route::get('/{id}/edit', 'edit');
    Route::put('/{id}/update','update');
    Route::delete('/{id}',  'destroy');
});

Route::scopeBindings()->group(function (){
    Route::get('users/{user}/posts/{post}', function (\App\Models\User $user, \App\Models\Post $post){
        return $post;
    });
});

enum Roles:string {
    case Admin = 'admin';
    case User = 'user';
}


Route::get('roles/{role}', function (Roles $role){
   return $role->value;
});
Route::get('post', function (){
    \App\Models\Post::first()->update(['state' => 'employee']);
});



Route::get('search', function (){
   return \App\Models\Post::whereFullText('body', 'nemo')->get();
});
