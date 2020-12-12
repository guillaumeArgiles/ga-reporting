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

Route::group(['middleware' => ['language']], function () {

	Route::get('/',['as' => 'home', function () {
		if(Auth::guest()){
		    return view('home-unlog');
		}
	 	return Redirect::route('reportings');

	}]);

	Route::get('/install', ['as' => 'install' , function () {
	    return view('install');
	}]);

	Route::get('/privacy-policy', ['as' => 'privacy-policy' , function () {
	    return view('privacy-policy');
	}]);

	Route::get('/support',['as' => 'support' , function () {
	    return view('support');
	}]);

	Route::group(['middleware' => ['auth']], function () {
		Route::group(['prefix' => 'slack'], function () {
			Route::get('/login',  'Slack@login');
			
			Route::get('/channels', ['as' => 'channels', 'uses' => 'Channels@channels'] );
			Route::get('/channel/test/{id_channel}',['as' => 'channel-test', 'uses' => 'Channels@test']);
			Route::get('/channel/delete/{id_channel}',['as' => 'channel-delete', 'uses' => 'Channels@delete']);
		});


		Route::group(['prefix' => 'ga'], function () {
			Route::get('/login', ['as' => 'ga-login', 'uses' => 'Google@login']);
			Route::get('/logout', ['as' => 'ga-logout', 'uses' => 'Google@logout']);
			Route::get('/save_accounts', ['as' => 'ga-save-accounts', 'uses' => 'Google@save_accounts']);
			Route::get('/accounts', ['as' => 'ga-accounts', 'uses' => 'Google@accounts']);
			Route::get('/account/test/{id_google_account}', ['as' => 'ga-account-test', 'uses' => 'Google@test']);
			Route::get('/account/delete/{id_google_account}', ['as' => 'ga-account-delete', 'uses' => 'Google@delete']);
		});


			Route::get('reportings/', ['as' => 'reportings', 'uses' => 'Reportings@reportings']);
			Route::get('reportings/add', ['as' => 'reporting-add', 'uses' => 'Reportings@add']);
			Route::post('reportings/add', ['as' => 'reporting-post-add', 'uses' => 'Reportings@add']);
			Route::get('reportings/edit/{summary_id}', ['as' => 'reporting-edit', 'uses' => 'Reportings@edit']);
			Route::post('reportings/edit/{summary_id}', ['as' => 'reporting-post-edit', 'uses' => 'Reportings@edit']);
			Route::get('reportings/delete/{summary_id}', ['as' => 'reporting-delete', 'uses' => 'Reportings@delete']);
			Route::get('reportings/test/{summary_id}', ['as' => 'reporting-test', 'uses' => 'Reportings@test']);
			Route::get('reportings/getNbSent', ['as' => 'reportings-sent', 'uses' => 'Reportings@getNbSent']);


	});

	Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
	Route::post('login', 'Auth\AuthController@postLogin');
	Route::get('logout',['as'  => 'logout', 'uses' => 'Auth\AuthController@logout']);

	// Registration routes...
	Route::get('register',['as'  => 'register', 'uses' => 'Auth\AuthController@getRegister']);
	Route::post('register', 'Auth\AuthController@postRegister');

	// Password reset link request routes...
	Route::get('password/email', ['as'  => 'password-forget', 'uses' => 'Auth\PasswordController@getEmail']);
	Route::post('password/email', 'Auth\PasswordController@postEmail');

	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');

});

	//change lang
	Route::get('lang/{lang}',['as'  => 'lang', 'uses' => 'Language@select']);

Route::get('{all}', function ($all) {
 return Redirect::to('/');
})
 ->where('all', '.*');

