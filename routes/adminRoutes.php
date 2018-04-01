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
	Route::get('/admin/patient/add', 'PatientsController@add')->name('admin.patient.add');
	Route::post('/admin/patient/add', 'PatientsController@store');
	
	// update patient's info
	Route::get('/admin/patient/update/{patient}','PatientsController@edit')->name('admin.patient.updatepatient');
	Route::PATCH('/admin/patient/update/{patient}', 'PatientsController@update');

	// view all patients
	Route::get('/admin/patient/view', 'PatientsController@index')->name('admin.patient.view');

	// activate or deactivate patient account
    Route::PATCH('/admin/patient/update/status/{patient}','PatientsController@change_status')->name('admin.patient.update.status');

    // delete patient account
    Route::DELETE('/admin/patient/delete/{patient}','PatientsController@destroy')->name('admin.patient.delete');
 
    // add new nurse 
	Route::get('/admin/nurse/add', 'NursesController@add')->name('admin.nurse.add');
	Route::post('/admin/nurse/add', 'NursesController@store');

	// View Nurses
	Route::get('/admin/nurse/view', 'NursesController@view')->name('admin.nurse.view');
	// update nurse's info
	Route::get('/admin/nurse/update/{nurse}', 'NursesController@edit')->name('admin.nurse.update');
	Route::PATCH('/admin/nurse/update/{nurse}', 'NursesController@update');
	Route::PATCH('/admin/nurse/status/{nurse}', 'NursesController@status')->name('admin.nurse.status');
	// Delete nurse
	Route::DELETE('/admin/nurse/delete/{nurse}','NursesController@destroy')->name('admin.nurse.delete');	


	//add a new admin
	Route::get('/admin/admin/add', 'AdminsController@add')->name('admin.admin.add');
	Route::post('/admin/admin/add', 'AdminsController@store');

	// View Admins
	Route::get('/admin/admin/view', 'AdminsController@view')->name('admin.admin.view');

	// update another admin's info
	Route::get('/admin/admin/update/{admin}', 'AdminsController@edit')->name('admin.admin.update');
	Route::PATCH('/admin/admin/update/{admin}', 'AdminsController@update');	
	Route::PATCH('/admin/admin/status/{admin}', 'AdminsController@status')->name('admin.admin.status');
	// Delete Another admin
	Route::DELETE('/admin/admin/delete/{admin}','AdminsController@destroy')->name('admin.admin.delete');

	//add a new clinic
	Route::get('/admin/clinic/add', 'ClinicsController@add')->name('admin.clinic.add');
	Route::post('/admin/clinic/add', 'ClinicsController@store');

	// View Clinics
	Route::get('/admin/clinic/view', 'ClinicsController@view')->name('admin.clinic.view');
	// Delete clinic
	Route::DELETE('/admin/clinic/delete/{clinic}','ClinicsController@destroy')->name('admin.clinic.delete');
	// update clinics's info
	Route::get('/admin/clinic/update/{clinic}', 'ClinicsController@edit')->name('admin.clinic.update');
	Route::PATCH('/admin/clinic/update/{clinic}', 'ClinicsController@update');
});
