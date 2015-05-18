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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix' => 'api/v1'], function(){
	Route::resource('users', 'Api\v1\UsersController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('user-statuses', 'Api\v1\UserStatusesController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('companies', 'Api\v1\CompaniesController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('calls', 'Api\v1\CallsController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
});
