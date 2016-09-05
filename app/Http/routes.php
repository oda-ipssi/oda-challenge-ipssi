<?php

// ----------------------------------------------------------------------------------------------------
// ACCUEIL

Route::get('/', 'IndexController@index');


// TEST
Route::get('test', 'TestController@index');
Route::get('test/scan', 'TestController@scanPermissions');


// ----------------------------------------------------------------------------------------------------
// AUTHENTIFICATION

// // Authentication Routes...
// $this->get('login', 'Auth\AuthController@showLoginForm');
// $this->post('login', 'Auth\AuthController@login');
// $this->get('logout', 'Auth\AuthController@logout');
//
// // Registration Routes...
// $this->get('register', 'Auth\AuthController@showRegistrationForm');
// $this->post('register', 'Auth\AuthController@register');
//
// // Password Reset Routes...
// $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
// $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
// $this->post('password/reset', 'Auth\PasswordController@reset');




Route::get('/home', 'HomeController@index');

// ----------------------------------------------------------------------------------------------------
// ROUTES AVEC AUTHENTIFICATION
// Ex: admin/role, admin/permission, etc.
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function() {

});


Route::group(['middleware' => ['auth', 'customer'], 'prefix' => 'customer'], function() {

    // Gestion des rôles
    Route::resource('role', 'RoleController', ['except' => [
        'show', 'create', 'edit'
    ]]);

});


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

/* Allow angular to access the api and return the right json*/
header('Access-Control-Allow-Origin: http://localhost:9000');
header('Access-Control-Allow-Methods: GET, POST, PUT' );
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers:  X-Requested-With, Content-Type, X-Auth-Token, Origin, Authorization');

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

// Gestion des rôles
Route::resource('associate', 'AssociateController', ['except' => ['show', 'create', 'edit']]);

Route::get('/content/{url}', ['uses' =>'ContentController@show']);

Route::get('/content/all', ['uses' =>'ContentController@index']);

Route::post('/content/store', ['uses' =>'ContentController@store']);

Route::get('/content/{url}/edit', ['uses' =>'ContentController@edit']);

Route::post('/content/{url}/update', ['uses' =>'ContentController@update']);

Route::delete('/content/{id}', ['uses' =>'ContentController@destroy'])->where(['id' => '[0-9]+']);

Route::put('/account/{id}/password', 'AccountController@editPassword')->where(['id' => '[0-9]+']);

Route::get('/account/{id}', 'AccountController@show')->where(['id' => '[0-9]+']);

Route::put('/account/{id}', 'AccountController@update')->where(['id' => '[0-9]+']);

/* Route to register a user */
Route::post('/registration', ['uses' => 'UsersController@createUser']);

/* Route to validate a user account with the token url */
Route::post('/validation/{token}', ['uses' => 'UsersController@validateUserAccount', 'as' => 'userValidation']);

Route::get('/send/{id}', ['uses' =>'EmailController@sendEmailReminder', 'as'=>'reminderEmail']);

Route::get('/payment','PaymentController@index');

Route::get('/payment/{id}/{mode?}','PaymentController@generateForm')->where(['id' => '[0-9]+']);
