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

Route::get('/', function () {
    return view('user.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/home', function () {
    return view('admin.home');
});

Route::get('/nurse/home', function () {
    return view('nurse.home');
});

// Admin routes
Route::group(['namespace' => 'Admin'],function(){
	// get admin login page
	Route::GET('admin/login','Auth\LoginController@showLoginForm')->name('admin.login');
	// login with admin
	Route::POST('admin/login','Auth\LoginController@login');
	// send email for admin to change password
	Route::POST('admin-password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	// show page of admin to write his email to change password
	Route::GET('admin-password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	// reset admin password
	Route::POST('admin-password/reset','Auth\ResetPasswordController@reset');
	// get page where admin reset password
	Route::GET('admin-password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
});
