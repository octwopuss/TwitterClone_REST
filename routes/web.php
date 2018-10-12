<?php
use App\Post;
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

Route::GET('/', 'UserController@index')->name('dashboard');
Route::GET('/login', 'UserController@login')->name('login');
Route::POST('/Auth', 'UserController@AuthenticateUser')->name('auth.user');
Route::GET('/logout', 'UserController@logout')->name('logout');