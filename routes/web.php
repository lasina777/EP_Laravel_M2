<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
})->name('welcome');

Route::get('/login', [UserController::class,'login'])->name('login');
Route::post('/login', [UserController::class,'loginPost']);

Route::get('/register',[UserController::class, 'register'])->name('register');
Route::post('/register',[UserController::class, 'registerPost']);

Route::middleware('auth')->group(function (){

    Route::get('/logout', [UserController::class,'logout'])->name('logout');
    Route::middleware('role:Admin')->group(function (){
        Route::group(['prefix' => '/admin', 'as' => 'admin.'], function (){
            Route::resource('/roles', RoleController::class);
        });
    });

    Route::resource('/posts', PostController::class);
});
