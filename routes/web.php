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

<<<<<<< HEAD
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
=======
Route::get('/admin/home', function () {
    return view('admin.home');
});

Route::get('/nurse/home', function () {
    return view('nurse.home');
});
>>>>>>> 66c7745fe2f8231f474245db3f2c12aeb147b82c
