<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\User;
use App\isarel\Models\Rola;
use App\isarel\Models\Permission;
use App\Role;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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

Auth::routes();
//Route::resource('roles', 'RoleController');
//->middleware('auth');
Route::get('/', 'HomeController@index')->name('home');

//codigo aumentado por israel
Route::resource('/rola', 'RolaController')->names('rola');

Route::resource('usuarios', 'UserController');

Route::resource('personalAcademico', 'PersonalAcademicoController')->middleware('auth');

Route::get('registrarUFC/registrarUnidad', 'RegistrarUFCController@createUnidad')->middleware('auth');
Route::post('registrarUFC/registrarUnidad', 'RegistrarUFCController@storeUnidad')->middleware('auth');
Route::get('registrarUFC/{id}/editarUnidad','RegistrarUFCController@editUnidad')->middleware('auth');
Route::patch('registrarUFC/editarUnidad/{id}','RegistrarUFCController@updateUnidad')->middleware('auth');
Route::delete('registrarUFC/eliminarUnidad/{id}','RegistrarUFCController@destroyUnidad')->middleware('auth');


Route::get('registrarUFC/registrarFacultad', 'RegistrarUFCController@createFacultad')->middleware('auth');
Route::post('registrarUFC/registrarFacultad', 'RegistrarUFCController@storeFacultad')->middleware('auth');
Route::get('registrarUFC/{id}/editarFacultad','RegistrarUFCController@editFacultad')->middleware('auth');
Route::patch('registrarUFC/editarFacultad/{id}','RegistrarUFCController@updateFacultad')->middleware('auth');
Route::delete('registrarUFC/eliminarFacultad/{id}','RegistrarUFCController@destroyFacultad')->middleware('auth');


Route::get('registrarUFC/registrarCarrera', 'RegistrarUFCController@createCarrera')->middleware('auth');
Route::post('registrarUFC/registrarCarrera', 'RegistrarUFCController@storeCarrera')->middleware('auth');
Route::get('registrarUFC/{id}/editarCarrera','RegistrarUFCController@editCarrera')->middleware('auth');
Route::patch('registrarUFC/editarCarrera/{id}','RegistrarUFCController@updateCarrera')->middleware('auth');
Route::delete('registrarUFC/eliminarCarrera/{id}','RegistrarUFCController@destroyCarrera')->middleware('auth');


Route::resource('registrarUFC', 'RegistrarUFCController')->middleware('auth');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');


Route::resource('post', 'PostController');

Route::get('/test',function(){

  //Se crear un usuario de prueba
  /*
    DB::table('users')->insert([
        'id' => '1003',
        'name' => 'Ronaldinho',
        'email' => 'ronaldinho@gmail.com',
        'password' => bcrypt('sistemas'), 
      ]);
      
      */
     $user = User::find(1003);
    //return User::get();
  
    //el indica que las usuario se le asigna el ese (Antes de hacer esto es necesario que el rol ya exista)
    //$user->rolas()->sync([2]);

    Gate::authorize('haveaccess','rola.show');
    return $user;
   //return $user->havePermission('rola.create');
});


