<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
// Route::post('login', 'Auth\LoginController@login');   
// Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/', function () {
    return view('user.index');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/home', function () {
    return view('admin.home');
})->middleware('auth:admin');

Route::post('addpatient','admin\patientcontroller@storePatientInfo');              
Route::post('addadmin','admin\admincontroller@storeAdminInfo');                    
Route::get('/nurse/home', function () {
    return view('nurse.home');
});
// get home page route (it must be added to controller later)
Route::get('/', function () {
    return view('user.index');
});

// Patient routes
Route::group(['namespace' => 'Patient'],function(){
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
	Route::get('/admin/home', 'HomeController@index');
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

	// add new nurse routes
	Route::get('/admin/nurse/add', 'NurseController@add');
	Route::post('/admin/nurse/add', 'NurseController@store');
	//add a new patient
	Route::get('/admin/patient/addpatient', 'PatientController@add');
	Route::post('/admin/patient/addpatient', 'patientcontroller@storePatientInfo');


//add a new admin
	Route::get('/admin/admin/addadmin', 'admincontroller@add');
	Route::post('/admin/admin/addadmin', 'admincontroller@storeAdminInfo');

/*	Route::get('/admin/admin/addadmin', function () {
		return view('admin.admin.addadmin');
    });
*/
/*	Route::get('/admin/patient/addpatient', function () {
		return view('admin.patient.addpatient');
    });
*/
});



// Nurse routes
Route::group(['namespace' => 'Nurse'],function(){
	// Get Nurse Home page
	Route::get('/nurse/home', 'HomeController@index');

	// add new patient routes
	Route::get('/nurse/patient/add', 'PatientController@add');
	Route::post('/nurse/patient/add', 'PatientController@store');

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

	/*Route::get('/nurse/patient/add', function () {
		return view('nurse.patient.add');
	});
*/
});