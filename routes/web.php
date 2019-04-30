<?php

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

Route::resource('arma/fabricante', 'FabricanteController');
Route::resource('arma/calibre', 'CalibreController');
Route::resource('arma/tipo', 'TipoController');
Route::resource('arma/modelo', 'ModeloController');
Route::resource('arma/arma', 'ArmaController');