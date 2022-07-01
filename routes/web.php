<?php


use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthUserController;
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

Route::middleware('userAuthCheck')->group(function(){
    Route::delete('users/{id}',[userController::class,'remove']);
    Route::get('users/edit/{id}',[userController :: class , 'edit']);
    Route::put('users/update/{id}',[userController :: class , 'update']);

});
Route::get('users/create',[userController::class,'create']);
Route::post('users/store',[userController::class,'store']);
Route::get('users',[userController::class,'index']);


Route::get('Login',[AuthUserController :: class,'login']);
Route::post('DOLogin',[AuthUserController :: class,'doLogin']);


// Route::resource('tasks', TaskController::class)->middleware('RemoveTask');

Route::get('tasks',[TaskController::class , 'index']);
Route::get('tasks/create',[TaskController::class , 'create']);
Route::post('tasks',[TaskController :: class , 'store']);
Route::delete('tasks/{id}',[TaskController :: class , 'destroy'])->middleware('RemoveTask');