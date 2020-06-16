<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::group(['middleware' => ['jwt.verify']], function() {
    /*AÑADE AQUI LAS RUTAS QUE QUIERAS PROTEGER CON JWT*/
    Route::get('rol', 'RolController@index');
    Route::post('rol', 'RolController@create');
    Route::get('rol/{id}', 'RolController@detail');
    Route::delete('rol/{id}', 'RolController@destroy');
    Route::put('rol/{id}', 'RolController@update');


    /**@api
     * Url:api/rol/modulo
     * Params:{"seg_modulo_id":["2"],"seg_rol_id":"00001C0001","Parent_seg_modulo_id":"1"}
     */
    Route::post('rol-modulo', 'SegRolModuloController@asignar_modulos_rol');



    /**@api
     * el filtro es por params url
     *Url:/api/rol-modulo?seg_rol_id=CO15392961296420198&seg_modulo_id=000001
     */
    Route::get('rol-modulo', 'SegRolModuloController@listar_modulo_rol');


    /**@api
     * Asigna Roles a un usuario
     * Url:setup/rol-usuario/
     * Params:{"user_id":"1","seg_rol_id":["CO15392960965741170","CO15392961296420198"]}
     */
    Route::post('rol-usuario', 'SegRolUsuarioController@asignar_roles_usuario');




    /**@api
     * Filtra el menu segun los roles y permisos de cada usuario
     * Url:api/rol-usuario/1
     */
    Route::get('rol-usuario/{userid}', 'SegRolUsuarioController@listar_roles_asignados_usuario');

});


