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
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE' );
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

                // Gestion des associate
                Route::resource('associate', 'AssociateController', ['except' => [
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
        * Account
        * -----------------------------------------------------
        */

        Route::put('/account/{id}/password', 'AccountController@editPassword')->where(['id' => '[0-9]+']);

        Route::get('/account/{id}', 'AccountController@show')->where(['id' => '[0-9]+']);

        Route::put('/account/{id}', 'AccountController@update')->where(['id' => '[0-9]+']);


        /**
        * -----------------------------------------------------
        * Account validation
        * -----------------------------------------------------
        */

        Route::post('/validation/{token}', ['uses' => 'UsersController@validateUserAccount', 'as' => 'userValidation']);

        Route::get('/send/{id}', ['uses' =>'EmailController@sendEmailReminder', 'as'=>'reminderEmail']);


        /**
         * -----------------------------------------------------
         * Subscription
         * -----------------------------------------------------
         */
        Route::get('/subscription', 'SubscriptionController@getAllOrders');

        Route::get('/subscription/{id}', 'SubscriptionController@index')->where(['id' => '[0-9]+']);

        Route::post('/subscription','SubscriptionController@createSubscription');

        Route::delete('/subscription/{id}','SubscriptionController@deleteSubscription')->where(['id' => '[0-9]+']);

        Route::put('/subscription/{id}','SubscriptionController@changeSubscription')->where(['id' => '[0-9]+']);

        Route::put('/subscription/{id}/stop','SubscriptionController@stopSubscription')->where(['id' => '[0-9]+']);

        Route::get('/downloadInvoice/{id}', 'SubscriptionController@downloadInvoice')->where(['id' => '[0-9]+']);


        /**
         * -----------------------------------------------------
         * Payment
         * -----------------------------------------------------
         */

        Route::get('/payment','PaymentController@index');

        Route::get('/payment/{id}/{mode?}','PaymentController@generateForm')->where(['id' => '[0-9]+']);


        /**
         * -----------------------------------------------------
         * Offers
         * -----------------------------------------------------
         */

        Route::put('/offers/{id}', 'OfferController@update')->where(['id' => '[0-9]+']);

        Route::post('/offers', 'OfferController@create');

        Route::get('/offers','OfferController@getAllOffers');

        Route::delete('/offers/{id}','OfferController@delete')->where(['id' => '[0-9]+']);



    });
