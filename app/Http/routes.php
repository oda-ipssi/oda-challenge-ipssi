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

Route::auth(); // Contient l'ensemble des routes ci-dessus

// ----------------------------------------------------------------------------------------------------
// ROUTES AVEC AUTHENTIFICATION

// Ex: admin/role, admin/permission, etc.

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {

    // Gestion des rôles
    Route::resource('role', 'RoleController');

    // Gestion des permissions
    Route::resource('permission', 'PermissionController');
});