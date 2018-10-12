<?php

use Illuminate\Http\Request;

Route::get('/posts', 'PostController@posts');
Route::post('/posts', 'PostController@store')->name('moment.store');
Route::get('/posts/delete/{id}', 'PostController@delete')->name('moment.delete');