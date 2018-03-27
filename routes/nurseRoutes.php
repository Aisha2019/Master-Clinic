<?php
// Nurse routes
Route::group(['namespace' => 'Nurse'],function(){
	// Get Nurse Home page
	Route::get('/nurse/home', 'HomeController@index')->name('nurse.home');

	// Get Admin Home page
	Route::get('/nurse/profile', 'ProfileController@index')->name('nurse.profile');
	// Update Admin Profile Picture
	Route::post('/nurse/profile/update', 'ProfileController@updatePicture')->name('nurse.update.photo');
	// Change nurse data from profile
	Route::PATCH('/nurse/update', 'ProfileController@update')->name('nurse.profile.update');
	// Change nurse password
	Route::PATCH('/nurse/password/update', 'ProfileController@password')->name('nurse.password.update');

	// add new patient routes
	Route::get('/nurse/patient/add', 'PatientController@add')->name('nurse.patient.add');
	Route::post('/nurse/patient/add', 'PatientController@store');

	Route::get('/nurse/patient/update/{patientid}','PatientController@getpatient')->name('nurse.patient.updatepatient');
	
	Route::post('/nurse/patient/update', 'PatientController@update')->name('nurse.patient.update');
	
	Route::get('/nurse/patient/update','PatientController@get')->name('nurse.patient.update');


	Route::get('/nurse/patient/view', 'PatientController@patient_table')->name('nurse.patient.view');


    Route::get('/nurse/patient/update/patientid/{pid}','PatientController@change_status')->name('nurse.patient.update.status');

    Route::get('/nurse/patient/table/{id}',[  "uses" => 'PatientController@delete'])->name('nurse.patient.table.delete');

	// get nurse login page
	Route::GET('nurse/login','Auth\LoginController@showLoginForm')->name('nurse.login');
	// login with nurse
	Route::POST('nurse/login','Auth\LoginController@login');
	Route::post('nurse/logout', 'Auth\LoginController@logout')->name('nurse.logout');
	// send email for nurse to change password
	Route::POST('nurse-password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('nurse.password.email');
	// show page of nurse to write his email to change password
	Route::GET('nurse-password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('nurse.password.request');
	// reset nurse password
	Route::POST('nurse-password/reset','Auth\ResetPasswordController@reset');
	// get page where nurse reset password
	Route::GET('nurse-password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('nurse.password.reset');
});