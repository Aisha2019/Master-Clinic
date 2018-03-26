<?php

// Admin routes
Route::group(['namespace' => 'Admin'],function(){
	// Get Admin Home page
	Route::get('/admin/home', 'HomeController@index')->name('admin.home');

	// Get Admin Home page
	Route::get('/admin/profile', 'ProfileController@index')->name('admin.profile');
	// Update Admin Profile Picture
	Route::post('/admin/profile/update', 'ProfileController@updatePicture')->name('admin.update.photo');
	// Change admin data from profile
	Route::PATCH('/admin/update', 'ProfileController@update')->name('admin.profile.update');
	// Change admin password
	Route::PATCH('/admin/password/update', 'ProfileController@password')->name('admin.password.update');

	// get admin login page
	Route::GET('admin/login','Auth\LoginController@showLoginForm')->name('admin.login');
	// login with admin
	Route::POST('admin/login','Auth\LoginController@login');
	Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
	// send email for admin to change password
	Route::POST('admin-password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	// show page of admin to write his email to change password
	Route::GET('admin-password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	// reset admin password
	Route::POST('admin-password/reset','Auth\ResetPasswordController@reset');
	// get page where admin reset password
	Route::GET('admin-password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

	// add new nurse 
	Route::get('/admin/nurse/add', 'NurseController@add')->name('admin.nurse.add');
	Route::post('/admin/nurse/add', 'NurseController@store');
	//add a new patient

	Route::get('/admin/patient/add', 'PatientController@add')->name('admin.patient.add');
	Route::post('/admin/patient/add', 'PatientController@store');

	//add a new admin
	Route::get('/admin/admin/add', 'AdminController@add')->name('admin.admin.add');
	Route::post('/admin/admin/add', 'AdminController@store');
	// update patient's info
		Route::get('/admin/patient/update', 'PatientController@update')->name('admin.patient.update');
	// View Patients
		Route::get('/admin/patient/view', 'PatientController@view')->name('admin.patient.view');
	// View Nurses
		Route::get('/admin/nurse/view', 'NurseController@view')->name('admin.nurse.view');
	// update nurse's info
		Route::get('/admin/nurse/update', 'NurseController@updatepage')->name('admin.nurse.update');
		Route::post('/admin/nurse/update', 'NurseController@update');

	// View Admins
		Route::get('/admin/admin/view', 'AdminController@view')->name('admin.admin.view');

	// update another admin's info
		Route::get('/admin/admin/update', 'AdminController@updatepage')->name('admin.admin.update');
		Route::post('/admin/admin/update', 'AdminController@update');	
});
