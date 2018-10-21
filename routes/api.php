<?php

use Illuminate\Http\Request;

Route::GET('/posts/{userId}', 'PostController@posts')->name('moment.Show');
Route::POST('/posts', 'PostController@store')->name('moment.store');
Route::GET('/popularTags', 'PostController@popularTags')->name('moment.popularTags');
Route::DELETE('/posts/{id}', 'PostController@delete')->name('moment.delete');
Route::POST('/friendship/create', 'PostController@createFriendship')->name('friend.create');
Route::POST('/friendship/cancel','PostController@cancelFriendRequest')->name('friend.cancel');
Route::GET('/user/{username}', 'PostController@showFriendPost')->name('friend.showPost');