<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//Route::auth();

Route::get('/home', 'HomeController@index');
Route::post('/dang-ky', 'UserController@register')->name('user.register');
Route::post('/dang-nhap', 'UserController@login')->name('user.login');
Route::get('/dang-xuat', 'UserController@logout')->name('user.logout');
Route::get('/dang-xuat-be', 'UserController@logoutbe')->name('user.logoutbe');
Route::get('/kiem-tra-email', 'UserController@isunique')->name('user.isunique');

include_once 'routes/shopBackEnd.php';
include_once 'routes/shopFrontEnd.php';