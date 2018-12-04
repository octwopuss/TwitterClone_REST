<?php
use App\Post;
use App\categories;
use App\Tags;
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
Route::GET('/profile', 'UserController@bio')->name('bio');
Route::GET('/login', 'UserController@login')->name('login');
Route::POST('/Auth', 'UserController@AuthenticateUser')->name('auth.user');
Route::GET('/logout', 'UserController@logout')->name('logout');
Route::GET('/user/{username}', 'UserController@showFriend')->name('showFriend');
Route::GET('/tags/{data}', 'UserController@postsByTags')->name('postsByTags');
Route::GET('/profile', 'UserController@editProfile')->name('editProfile');
Route::GET('/search-friend', 'UserController@searchFriend')->name('searchFriend');