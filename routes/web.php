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
    Route::get('addSitios', 'SuperAdminController@addSitios')->name('addSitios');

    Route::post('autoCompleUsuarios','SuperAdminController@autoCompleUsuarios')->name('autoCompleUsuarios');
    Route::post('traerUserXEmail','SuperAdminController@traerUserXEmail')->name('traerUserXEmail');

    Route::post('addNuevaMarca', 'SuperAdminController@addNuevaMarca')->name('addNuevaMarca');
    Route::post('removeMarca', 'SuperAdminController@removeMarca')->name('removeMarca');
    Route::post('editMarca', 'SuperAdminController@editMarca')->name('editMarca');

    Route::post('traerUserXEmailSitio','SuperAdminController@traerUserXEmailSitio')->name('traerUserXEmailSitio');
    Route::post('sitioXMarca','SuperAdminController@sitioXMarca')->name('sitioXMarca');


});

Route::group(['middleware' => ['auth', 'propietario']], function () {

    Route::get('propietario', function(){
        return "hola propietario";
    })->name('propietario');

    Route::get('propietario/perfil', 'PropietarioController@editarPerfil')->name('editarPerfil');
    Route::post('propietario/setInfo', 'PropietarioController@setInfo')->name('setInfo');
    Route::post('propietario/setContrasena', 'PropietarioController@setContrasena')->name('setContrasena');

    Route::get('propietario/marcas', 'PropietarioController@editarMarcas')->name('editarMarcas');
    Route::post('propietario/setMarca', 'PropietarioController@updateImagenMarca')->name('updateImagenMarca');

    Route::get('propietario/sitios', 'PropietarioController@editarSitios')->name('editarSitios');
    Route::post('propietario/getSitios', 'PropietarioController@getSitiosxMarca')->name('getSitiosxMarca');
    Route::get("propietario/sitio/{id}", 'PropietarioController@getSitio')->name('getSitio');
    Route::get('propietario/horarios/{id}', 'PropietarioController@editHorarios')->name('editHorarios');
    Route::post('propietario/updateInfo', 'PropietarioController@updateInfoSitio')->name('updateInfoSitio');

    Route::get('mapa', function(){
        return view('propietario.mapa2');
    })->name('otra');
});

Route::group(['middleware' => ['auth', 'administrador']], function () {

    Route::get('administrador', function(){
        return "hola administrador";
    })->name('administrador');


});

