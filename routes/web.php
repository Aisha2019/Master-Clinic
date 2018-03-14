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

<<<<<<< HEAD
=======
Route::get('/home', 'HomeController@index')->name('home');

>>>>>>> 4253adf3b9c5061d2c1cb487b18cba65a7f7b7a2
Route::get('/admin/home', function () {
    return view('admin.home');
});

Route::get('/nurse/home', function () {
    return view('nurse.home');
});