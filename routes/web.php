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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('getPrize', 'HomeController@getPrize')->name('getPrize');
Route::get('genPrize', 'HomeController@generatePrize')->name('genPrize');
Route::get('resultPrize', 'HomeController@resultPrize')->name('resultPrize');

Route::post('declinePrize', 'HomeController@declinePrize')->name('declinePrize');
Route::post('collectPrize', 'HomeController@collectPrize')->name('collectPrize');
Route::post('convertToBonus', 'HomeController@convertToBonus')->name('convertToBonus');
//
Route::get('endGame', 'HomeController@gameOver')->name('gameOver');