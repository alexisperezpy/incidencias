<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProjectUserController;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::get('/', 'HomeController@getLogin')->name('login');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/proyecto/seleccionado/{id}', 'HomeController@selectProject');

// Incidencias
Route::get('/ver/{id}', 'IncidentController@show')->name('report.ver');
Route::get('/crear-incidencia', 'IncidentController@create')->name('report.create');
Route::post('/incidencia', 'IncidentController@store')->name('report.store');
Route::get('/incidencia/{id}', 'IncidentController@edit')->name('report.edit');
Route::get('/incidencia/{id}/update', 'IncidentController@update')->name('report.update');
Route::get('/incidencia/{id}/atender', 'IncidentController@atender')->name('report.atender');
Route::post('/incidencia/{id}/updateAcciones', 'IncidentController@updateAcciones')->name('report.updateAcciones');
Route::get('/incidencia/{id}/marcarResuelto', 'IncidentController@cerrarIncidente')->name('report.cerrarIncidente');


/* Acciones protegidas, se requiere login del admin */
Route::get('/incidencia{id}/elimnar', 'IncidentController@delete')->name('report.del')->middleware('admin');

Route::group(['middleware'=>'admin','namespace'=>'Admin'], function(){
    // usuarios
    Route::get('/usuarios', 'UserController@index')->name('user.index');
    Route::post('/usuarios', 'UserController@store')->name('user.store');
    Route::get('usuario/{id}', 'UserController@edit')->name('user.edit');
    Route::post('/usuario/{id}/update', 'UserController@update')->name('user.update');
    Route::get('/usuario/{id}/eliminar', 'UserController@delete')->name('user.del');
    
    // clientes
    Route::get('/clientes', 'ClientController@index')->name('clientes');
    Route::post('/clientes', 'ClientController@store')->name('client.store');
    Route::get('cliente/{id}', 'ClientController@edit')->name('client.edit');
    Route::post('/cliente/{id}/update', 'ClientController@update')->name('client.update');
    Route::get('/cliente/{id}/delete', 'ClientController@delete')->name('client.del');
    
    // proyectos
    Route::get('/proyectos', 'ProjectController@index')->name('project.index');
    Route::post('/proyectos', 'ProjectController@store')->name('project.store');
    Route::get('/proyecto/{id}', 'ProjectController@edit')->name('project.edit');
    Route::post('/proyecto/{id}/update', 'ProjectController@update')->name('project.update');
    Route::get('/proyecto/{id}/delete', 'ProjectController@delete')->name('project.del');
    Route::get('/proyecto/{id}/restore', 'ProjectController@restore')->name('project.restore');

    // categorias
    Route::post('/categoria', 'CategoryController@store')->name('categoria.store');
    Route::post('/categoria/update', 'CategoryController@update')->name('categoria.update');
    Route::get('/categoria/{id}/delete', 'CategoryController@delete')->name('categoria.del');

    // niveles
    Route::post('/nivel', 'LevelController@store')->name('nivel.store');
    Route::post('/nivel/update', 'LevelController@update')->name('nivel.update');
    Route::get('/nivel/{id}/delete', 'LevelController@delete')->name('nivel.del');

    // configuraciones
    Route::get('/config', 'ConfigController@index');

    // project-user 
    Route::post('/proyecto-usuario','ProjectUserController@store')->name('projectUser.store');
    Route::get('/proyecto-usuario/{id}/eliminar', 'ProjectUserController@delete')->name('projectUser.del');

});