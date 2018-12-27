<?php

use Illuminate\Http\Request;

Route::GET('/posts/{userId}', 'PostController@posts')->name('moment.Show');
Route::POST('/posts', 'PostController@store')->name('moment.store');
Route::GET('/recent', 'PostController@recent')->name('moment.recent');
Route::GET('/popularTags', 'PostController@popularTags')->name('moment.popularTags');
Route::DELETE('/posts/{id}', 'PostController@delete')->name('moment.delete');
Route::GET('/tags/{tags}', 'PostController@postsByTag')->name('moment.byTag');
Route::POST('/friendship/create', 'PostController@createFriendship')->name('friend.create');
Route::POST('/friendship/cancel','PostController@cancelFriendRequest')->name('friend.cancel');
Route::GET('/user/{username}', 'PostController@showFriendPost')->name('friend.showPost');
Route::GET('/search', 'PostController@searchFriend')->name('friend.search');
Route::GET('/comment/{id}', 'PostController@showComment')->name('comment.show');
Route::POST('/comment/{id}', 'PostController@storeComment')->name('comment.store');