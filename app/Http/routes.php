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

Route::get('/', 'IndexController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['namespace' => 'Api\v1', 'prefix' => 'api/v1'/*, 'middleware' => ['auth.basic.once', 'auth']*/ ], function(){
	Route::resource('users', 'UsersController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('user-statuses', 'UserStatusesController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('companies', 'CompaniesController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
	Route::resource('calls', 'CallsController', ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
});

//Route::group(['namespace' => 'Widget', 'prefix' => 'api/v1', 'middleware' => ['auth.basic.once','auth'] ], function(){
//	Route::get('widget-setup', 'WidgetController@setup' );
//});

