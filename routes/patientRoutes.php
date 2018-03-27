<?php


// Patient routes
Route::group(['namespace' => 'Patient'],function(){

	// Change paient profile photo
	Route::POST('/patient/photo', 'PatientController@photo');
	// Change patient data from profile
	Route::PATCH('/patient/update', 'PatientController@update')->name('patient.profile');
	// Change patient password
	Route::PATCH('/patient/password/update', 'PatientController@password')->name('patient.password.update');

	// patient login routes
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');   
	// patient logout route
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

	// patient reset password routs (not working yet)
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::get('/home', 'HomeController@index')->name('home');
});