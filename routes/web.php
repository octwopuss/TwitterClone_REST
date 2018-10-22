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
Route::GET('/login', 'UserController@login')->name('login');
Route::POST('/Auth', 'UserController@AuthenticateUser')->name('auth.user');
Route::GET('/logout', 'UserController@logout')->name('logout');
Route::GET('/user/{username}', 'UserController@showFriend')->name('showFriend');
Route::GET('/tags/{data}', 'UserController@postsByTags')->name('postsByTags');
Route::GET('/test', function(){	
	$tags = Tags::find(2)->post()->get();
	foreach($tags as $tag){
		echo $tag->description.'<br>';
	}
});

Route::GET('/cek', function(){
	$some = 'hello';
	$data = explode(',', $some);
	print_r($data);
});