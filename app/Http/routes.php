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

Route::resource('subscription', 'SubscriptionController');

Route::get('/stopSubscription/{id}', ['uses' =>'SubscriptionController@stopSubscription']);

Route::get('/renewSubscription/{id}', ['uses' =>'SubscriptionController@renewSubscription']);

Route::get('/downloadInvoice/{id}', ['uses' =>'SubscriptionController@downloadInvoice']);





