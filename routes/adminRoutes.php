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

	Route::get('/admin/patient/update/{patientid}','PatientController@getpatient')->name('admin.patient.updatepatient');

    Route::get('/admin/patient/update','PatientController@get')->name('admin.patient.update');

	Route::post('/admin/patient/update', 'PatientController@update');


	Route::get('/admin/patient/table', 'PatientController@patient_table')->name('admin.patient.table');


    Route::get('/admin/patient/update/patientid/{pid}','PatientController@change_status')->name('admin.patient.update.status');

    Route::get('/admin/patient/table/{id}',[  "uses" => 'PatientController@delete'])->name('admin.patient.table.delete');
 
	// View Patients
		Route::get('/admin/patient/view', 'PatientController@view')->name('admin.patient.view');
	// View Nurses
		Route::get('/admin/nurse/view', 'NurseController@view')->name('admin.nurse.view');
	// update nurse's info
		Route::get('/admin/nurse/update/{nurseid}', 'NurseController@updatepage')->name('admin.nurse.update');
		Route::post('/admin/nurse/update/{nurseid}', 'NurseController@update');
		Route::get('/admin/admin/status/{nurseid}', 'NurseController@status')->name('admin.nurse.status');
	// Delete nurse
	
		Route::get('/admin/nurse/delete/{nurseid}','NurseController@delete')->name('admin.nurse.delete');	

	// View Admins
		Route::get('/admin/admin/view', 'AdminController@view')->name('admin.admin.view');

	// update another admin's info
		Route::get('/admin/admin/update/{adminid}', 'AdminController@updatepage')->name('admin.admin.update');
		Route::post('/admin/admin/update/{adminid}', 'AdminController@update');	
		Route::get('/admin/admin/status/{adminid}', 'AdminController@status')->name('admin.admin.status');
	// Delete Another admin
	
		Route::get('/admin/admin/delete/{id}','AdminController@delete')->name('admin.admin.delete');

});
