<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    //Route::resource('todo', 'TodoController', ['only' => ['index']]);
    Route::resource('user', 'UserController');

    Route::get('/nasa', 'NasaController@index');
    Route::get('/nasa/apod', 'NasaController@apod');
    Route::get('/nasa/neo-feed', 'NasaController@neoFeed');
    Route::get('/nasa/neo-lookup', 'NasaController@neoLookup');
});