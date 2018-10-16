<?php

use Illuminate\Http\Request;

Route::get('/posts', 'PostController@posts')->name('moment.Show');
Route::post('/posts', 'PostController@store')->name('moment.store');
Route::get('/popularTags', 'PostController@popularTags')->name('moment.popularTags');
Route::delete('/posts/{id}', 'PostController@delete')->name('moment.delete');
Route::post('/friendship/create', 'PostController@createFriendship')->name('friend.create');