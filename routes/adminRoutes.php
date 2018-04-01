<?php

// Admin routes
Route::group(['namespace' => 'Admin'],function(){
	// Get Admin Home page
	Route::get('/admin/home', 'HomeController@index')->name('admin.home');

	// Get Admin Profile page
	Route::get('/admin/profile', 'ProfileController@index')->name('admin.profile');
	// Update Admin Profile Picture
	Route::PATCH('/admin/profile/update', 'ProfileController@updatePicture')->name('admin.update.photo');
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
	
	//add a new patient
	Route::get('/admin/patient/add', 'PatientController@add')->name('admin.patient.add');
	Route::post('/admin/patient/add', 'PatientController@store');
	
	// update patient's info
	Route::get('/admin/patient/update/{patient}','PatientController@edit')->name('admin.patient.updatepatient');
	Route::PATCH('/admin/patient/update/{patient}', 'PatientController@update');

	// view all patients
	Route::get('/admin/patient/view', 'PatientController@index')->name('admin.patient.view');

	// activate or deactivate patient account
    Route::PATCH('/admin/patient/update/status/{patient}','PatientController@change_status')->name('admin.patient.update.status');

    // delete patient account
    Route::DELETE('/admin/patient/delete/{patient}','PatientController@destroy')->name('admin.patient.delete');
 
    // add new nurse 
	Route::get('/admin/nurse/add', 'NurseController@add')->name('admin.nurse.add');
	Route::post('/admin/nurse/add', 'NurseController@store');

	// View Nurses
	Route::get('/admin/nurse/view', 'NurseController@view')->name('admin.nurse.view');
	// update nurse's info
	Route::get('/admin/nurse/update/{nurse}', 'NurseController@edit')->name('admin.nurse.update');
	Route::PATCH('/admin/nurse/update/{nurse}', 'NurseController@update');
	Route::PATCH('/admin/nurse/status/{nurse}', 'NurseController@status')->name('admin.nurse.status');
	// Delete nurse
	Route::DELETE('/admin/nurse/delete/{nurse}','NurseController@destroy')->name('admin.nurse.delete');	


	//add a new admin
	Route::get('/admin/admin/add', 'AdminController@add')->name('admin.admin.add');
	Route::post('/admin/admin/add', 'AdminController@store');

	// View Admins
	Route::get('/admin/admin/view', 'AdminController@view')->name('admin.admin.view');

	// update another admin's info
	Route::get('/admin/admin/update/{admin}', 'AdminController@edit')->name('admin.admin.update');
	Route::PATCH('/admin/admin/update/{admin}', 'AdminController@update');	
	Route::PATCH('/admin/admin/status/{admin}', 'AdminController@status')->name('admin.admin.status');
	// Delete Another admin
	Route::DELETE('/admin/admin/delete/{admin}','AdminController@destroy')->name('admin.admin.delete');

	//add a new clinic
	Route::get('/admin/clinic/add', 'ClinicController@add')->name('admin.clinic.add');
	Route::post('/admin/clinic/add', 'ClinicController@store');

	// View Clinics
	Route::get('/admin/clinic/view', 'ClinicController@view')->name('admin.clinic.view');
	// Delete clinic
	Route::DELETE('/admin/clinic/delete/{clinic}','ClinicController@destroy')->name('admin.clinic.delete');
	// update clinics's info
	Route::get('/admin/clinic/update/{clinic}', 'ClinicController@edit')->name('admin.clinic.update');
	Route::PATCH('/admin/clinic/update/{clinic}', 'ClinicController@update');
});
