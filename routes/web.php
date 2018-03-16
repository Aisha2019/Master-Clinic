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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');   
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::get('/', function () {
    return view('user.index');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/home', function () {
    return view('admin.home');
})->middleware('auth:admin');

Route::get('/nurse/home', function () {
    return view('nurse.home');
});

// Admin routes
Route::group(['namespace' => 'Admin'],function(){
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
});

Route::get('/nurse/patient/add', function () {
    return view('nurse.patient.add');
});
Route::post('/nurse/patient/add', 'nurse\PatientController@store');


Route::get('/test', function() {
    return view('test');
});
