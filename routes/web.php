<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|
*/                  

// get home page route (it must be added to controller later)
Route::get('/', function () {
    return view('user.index');
});

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


// Admin routes
Route::group(['namespace' => 'Admin'],function(){
	// Get Admin Home page
	Route::get('/admin/home', 'HomeController@index')->name('admin.home');

	// Get Admin Home page
	Route::get('/admin/profile', 'ProfileController@index')->name('admin.profile');
	// Update Admin Profile Picture
	Route::post('/admin/profile/update_picture', 'ProfileController@updatePicture')->name('admin.update.profile_picture');

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
		Route::get('/admin/nurse/update', 'NurseController@update')->name('admin.nurse.update');

	// View Admins
		Route::get('/admin/admin/view', 'AdminController@view')->name('admin.admin.view');

	// update another admin's info
		Route::get('/admin/admin/update', 'AdminController@update')->name('admin.admin.update');
	
});



// Nurse routes
Route::group(['namespace' => 'Nurse'],function(){
	// Get Nurse Home page
	Route::get('/nurse/home', 'HomeController@index');

	// Get Admin Home page
	Route::get('/nurse/profile', 'ProfileController@index')->name('nurse.profile');
	// Update Admin Profile Picture
	Route::post('/nurse/profile/update_picture', 'ProfileController@updatePicture')->name('nurse.update.profile_picture');

	// add new patient routes
	Route::get('/nurse/patient/add', 'PatientController@add')->name('nurse.patient.add');
	Route::post('/nurse/patient/add', 'PatientController@store');

	Route::get('/nurse/patient/update', 'PatientController@update')->name('nurse.patient.update');

		Route::get('/nurse/patient/table', 'PatientController@table')->name('nurse.patient.table');

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