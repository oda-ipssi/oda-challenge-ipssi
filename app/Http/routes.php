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
 * Log out
 * -----------------------------------------------------
 */
Route::get('/logout', 'AuthenticateController@logOut');

/**
 * -----------------------------------------------------
 * Registration
 * -----------------------------------------------------
 */

Route::post('/registration', ['uses' => 'UsersController@createUser'])->name('registration');

/**
 * -----------------------------------------------------
 * Account validation
 * -----------------------------------------------------
 */

Route::post('/validation/{token}', ['uses' => 'UsersController@validateUserAccount', 'as' => 'userValidation']);

Route::get('/send/{id}', ['uses' =>'EmailController@sendEmailReminder', 'as'=>'reminderEmail']);

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

Route::get('/offers/{id}','OfferController@show')->where(['id' => '[0-9]+']);


/**
 * -----------------------------------------------------
 * Tables
 * -----------------------------------------------------
 */
Route::post('/table/test', ['uses' =>'TableController@testTable'])->middleware('cors');

Route::post('/test/jables', ['middleware' => 'cors', function(Request $request)
{
    dump($request);
    die;
    return response()->json(['status' => '200', 'message' => "Je suis ton PERE"]);
}]);


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
     * Check if current user is an admin
     * -----------------------------------------------------
     */
    Route::get('is-admin', 'UsersController@isAdmin');

    /**
     * -----------------------------------------------------
     * Roles, permission...
     * -----------------------------------------------------
     */

    Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function() {

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
         * Offers
         * -----------------------------------------------------
         */

        Route::get('/offers','OfferController@getAllOffers');

        Route::put('/offers/{id}', 'OfferController@update')->where(['id' => '[0-9]+']);

        Route::post('/offers', 'OfferController@create');

        Route::delete('/offers/{id}','OfferController@delete')->where(['id' => '[0-9]+']);

        /**
         * -----------------------------------------------------
         * Orders
         * -----------------------------------------------------
         */

        Route::get('/orders','OrderController@getAllOrders');

        Route::get('/orders/{id}','OrderController@show')->where(['id' => '[0-9]+']);;

        Route::get('/orders/{id}/download','OrderController@downloadInvoice')->where(['id' => '[0-9]+']);


        /**
         * -----------------------------------------------------
         * Dashboard
         * -----------------------------------------------------
         */

        Route::get('dashboard/active-users', 'DashboardController@getActiveUsersNumber')->name('dashboard_active_users');

        Route::get('dashboard/valid-orders', 'DashboardController@getValidOrdersNumber')->name('dashboard_valid_order');

        Route::get('dashboard/databases', 'DashboardController@getDatabasesNumber')->name('dashboard_databases');

        Route::get('dashboard/email', 'DashboardController@getEmailFromActiveUsers')->name('dashboard_email_active_users');

        Route::get('dashboard/messages', 'DashboardController@getContactMessages')->name('dashboard_contact_messages');



    });

    Route::group(['middleware' => ['customer'], 'prefix' => 'customer'], function() {

        // Gestion des associate
        Route::resource('associate', 'AssociateController', ['except' => [
            'show', 'create', 'edit'
        ]]);

    });


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
     * Subscription
     * -----------------------------------------------------
     */

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

    Route::get('/payment/{id}','PaymentController@index')->where(['id' => '[0-9]+']);

    Route::get('/checkout/{id}','PaymentController@generateForm')->where(['id' => '[0-9]+'])->name('checkout');



});




/**
 * Own user Table Management
 *
 */
Route::get('/table', ['uses' =>'TableController@storeTable']);

