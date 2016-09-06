<?php

/**
 * ----------------------------------------------------------------------------------------------------
 *
 * HEADER FOR CROSS DOMAINS
 * This below might be useless regardless to Barryvdh\Cors\ handler
 *
 * ----------------------------------------------------------------------------------------------------
 */

header('Access-Control-Allow-Origin: http://localhost:9000');
header('Access-Control-Allow-Methods: GET, POST, PUT' );
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers:  X-Requested-With, Content-Type, X-Auth-Token, Origin, Authorization');


/**
 * ----------------------------------------------------------------------------------------------------
 *
 * API AUTHENTICATION WITH JWT
 *
 * The authentication process rests on two conductors :
 *     - jwt.auth : a middleware which retrieves a user set into a cookie when the logging step is a success
 *     - jwt.refresh : a middleware which refreshes an expired token (120min)
 *
 * ----------------------------------------------------------------------------------------------------
 */

        /**
         * -----------------------------------------------------
         * Sign in
         * -----------------------------------------------------
         */

        Route::post('/sign-in', 'AuthenticateController@authenticate');


        Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function() {


        /**
         * -----------------------------------------------------
         * Home
         * -----------------------------------------------------
         */

        Route::get('/', 'IndexController@index');

        Route::get('/home', 'HomeController@index');


        /**
         * -----------------------------------------------------
         * Test
         * -----------------------------------------------------
         */

        Route::get('test', 'TestController@index');

        Route::get('test/scan', 'TestController@scanPermissions');


        /**
         * -----------------------------------------------------
         * Roles, permission...
         * -----------------------------------------------------
         */

        Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function() {

        });

        Route::group(['middleware' => ['customer'], 'prefix' => 'customer'], function() {

            // Gestion des rôles
            Route::resource('role', 'RoleController', ['except' => [
                'show', 'create', 'edit'
            ]]);

        });


        /**
         * -----------------------------------------------------
         * Content
         * -----------------------------------------------------
         */

        Route::get('/content/all', ['uses' =>'ContentController@index']);

        Route::get('/content/{url}', ['uses' =>'ContentController@show']);

        Route::post('/content/store', ['uses' =>'ContentController@store']);

        Route::get('/content/{url}/edit', ['uses' =>'ContentController@edit']);

        Route::post('/content/{url}/update', ['uses' =>'ContentController@update']);

        Route::delete('/content/{id}', ['uses' =>'ContentController@destroy'])->where(['id' => '[0-9]+']);


        /**
         * -----------------------------------------------------
         * Registration
         * -----------------------------------------------------
         */

        Route::post('/registration', ['uses' => 'UsersController@createUser']);


        /**
         * -----------------------------------------------------
         * Validation
         * -----------------------------------------------------
         */


        Route::resource('subscription', 'SubscriptionController');

        Route::get('/stopSubscription/{id}', ['uses' =>'SubscriptionController@stopSubscription']);

        Route::get('/renewSubscription/{id}', ['uses' =>'SubscriptionController@renewSubscription']);

        Route::get('/downloadInvoice/{id}', ['uses' =>'SubscriptionController@downloadInvoice']);

        Route::get('/payment','PaymentController@index');

        Route::get('/payment/{id}/{mode?}','PaymentController@generateForm')->where(['id' => '[0-9]+']);

        Route::post('/validation/{token}', ['uses' => 'UsersController@validateUserAccount', 'as' => 'userValidation']);

        Route::get('/send/{id}', ['uses' =>'EmailController@sendEmailReminder', 'as'=>'reminderEmail']);


        /**
         * -----------------------------------------------------
         * Payment
         * -----------------------------------------------------
         */

        Route::get('/payment','PaymentController@index');

        Route::get('/payment/{id}/{mode?}','PaymentController@generateForm')->where(['id' => '[0-9]+']);


    });

// BULLSHIT COMMENTED TO DELETE ? :-)
//--------------------------------------

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
// $this->post('password/reset', 'Auth\


