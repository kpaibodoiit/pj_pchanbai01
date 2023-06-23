<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','UserController@topPage')->name('home.top');
//Route::post('/','UserController@store')->name('auth.post');


Route::get('/login','UserController@showLogin')->name('auth.showLogin');
Route::post('/mypage','UserController@loginUser')->name('auth.login');


Route::get('/resetPassword','UserController@resetPass')->name('auth.resetPass');
Route::post('/resetPassword','UserController@resetPassword')->name('auth.resetPassword');


Route::get('/register','UserController@showRegister')->name('auth.showRegister');
Route::post('/register','UserController@registerUser')->name('auth.register');

Route::post('logout','UserController@logout')->name('auth.logout');