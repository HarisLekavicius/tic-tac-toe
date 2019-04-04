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

Route::resource('/', 'GameController');
Route::resource('test_json', 'Api\TicTacToeController');
Route::post('/request', 'GameController@store')->name('gameController');
Route::post('/logs', 'GameController@logs');
Route::post('/currentPlayer', 'GameController@currentPlayer');
Route::post('/markers', 'GameController@markers');
