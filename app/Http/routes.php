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

Route::get('/send/{id}', ['uses' =>'EmailController@sendEmailReminder', 'as'=>'reminderEmail']);




Route::get('/{url}', ['uses' =>'ContentController@show']);

Route::get('/content/all', ['uses' =>'ContentController@index']);

Route::post('/content/store', ['uses' =>'ContentController@store']);

Route::get('/content/{url}/edit', ['uses' =>'ContentController@edit']);

Route::post('/content/{url}/update', ['uses' =>'ContentController@update']);

Route::delete('/content/{id}', ['uses' =>'ContentController@destroy']);


