<?php


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
 * Home
 * -----------------------------------------------------
 */

Route::get('/', 'IndexController@index');

Route::get('/home', 'HomeController@index');

/**
 * -----------------------------------------------------
 * Sign in
 * -----------------------------------------------------
 */

Route::post('/sign-in', 'AuthenticateController@authenticate');

/**
 * -----------------------------------------------------
 * Registration
 * -----------------------------------------------------
 */

Route::post('/registration', ['uses' => 'UsersController@createUser'])->name('registration');

/**
 * -----------------------------------------------------
 * Content
 * -----------------------------------------------------
 */

Route::get('/content/{url}', ['uses' =>'ContentController@show']);


/**
 * -----------------------------------------------------
 * Offers
 * -----------------------------------------------------
 */

Route::get('/offers','OfferController@getAllOffers');


Route::post('/table/test', ['uses' =>'TableController@testTable']);


Route::group(['middleware' => ['jwt.auth', 'jwt.refresh']], function() {


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


    Route::get('/contents', ['uses' =>'ContentController@index']);

    Route::post('/content/store', ['uses' =>'ContentController@store']);

    Route::get('/content/{url}/edit', ['uses' =>'ContentController@edit']);

    Route::post('/content/{url}/update', ['uses' =>'ContentController@update']);

    Route::delete('/content/{id}', ['uses' =>'ContentController@destroy'])->where(['id' => '[0-9]+']);





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
    Route::get('/subscriptions', 'SubscriptionController@getAllOrders');

    Route::get('/subscription', 'SubscriptionController@getOrder');

    Route::post('/subscription','SubscriptionController@subscriptionFactory');

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

    Route::delete('/offers/{id}','OfferController@delete')->where(['id' => '[0-9]+']);



});

Route::post('/create/table', ['uses' =>'TableController@storeTable']);

Route::get('/up/table', ['uses' =>'TableController@populateTable']);

Route::get('/get/user-table', ['uses' =>'TableController@getDataTable']);

Route::get('/get-data/user-table', ['uses' =>'TableController@getDataForChoosenTable']);


