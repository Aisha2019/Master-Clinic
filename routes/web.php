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
Route::post('logout', 'Auth\LoginController@logout');
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
});

Route::get('/nurse/home', function () {
    return view('nurse.home');
});
Route::get('/admin/patient/addpatient', function () {
    return view('admin.patient.addpatient');
});
Route::get('/admin/admin/addadmin', function () {
    return view('admin.admin.addadmin');
});

<<<<<<< HEAD
Route::get('/admin/patient/addpatient', function () {
    return view('admin.patient.addpatient');
});
=======

Route::get('/nurse/patient/add', function () {
    return view('nurse.patient.add');
});
Route::post('/nurse/patient/add', 'nurse\PatientController@store');


Route::get('/test', function() {
    return view('test');
});
<<<<<<< HEAD
>>>>>>> acf686b9ad9db5b2bdaffac614b5556aac5a15e2
=======

>>>>>>> b8ae1f53329c24c657a4c473ffd4ac8864894f76
