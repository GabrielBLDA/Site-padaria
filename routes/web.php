<?php

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
Auth::routes();

Route::get('/', 'BoloController@index')->name('bolo.index');
Route::get('/home', 'BoloController@index')->name('home');
Route::post('/favoritar/{bolo}', 'FavoritoController@store')->name('favoritar');

Route::resource('bolo', BoloController::class);   

Route::fallback(function(){
    return view('fallback_erro');
});