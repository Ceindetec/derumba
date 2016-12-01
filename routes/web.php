<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', ['as' =>'login', 'uses' => 'Auth\LoginController@login']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

Route::get('password/email', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('getEmail');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('postEmail');


Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => ['auth', 'superAdmin']], function () {

    Route::get('superAdmin', function(){
        return "Hola super admin";
    })->name('superAdmin');
    Route::get('registroPropietario', 'SuperAdminController@registroPropietario')->name('registroPropietario');
    Route::post('addPropietario', 'SuperAdminController@addPropietario')->name('addPropietario');
    Route::post('municipios','SuperAdminController@getMunicipios')->name('municipios');

    Route::get('addMarcas', 'SuperAdminController@addMarcas')->name('addMarcas');
});

Route::group(['middleware' => ['auth', 'propietario']], function () {

    Route::get('propietario', function(){
        return "hola propietario";
    })->name('propietario');

    Route::get('propietario/perfil', 'PropietarioController@editarPerfil')->name('editarPerfil');
    Route::post('propietario/setInfo', 'PropietarioController@setInfo')->name('setInfo');
    Route::post('propietario/setContrasena', 'PropietarioController@setContrasena')->name('setContrasena');
});

Route::group(['middleware' => ['auth', 'administrador']], function () {

    Route::get('administrador', function(){
        return "hola administrador";
    })->name('administrador');


});

