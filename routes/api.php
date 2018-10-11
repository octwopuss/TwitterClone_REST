<?php

use Illuminate\Http\Request;

Route::get('posts', 'PostController@posts');
Route::post('/posts', 'PostController@store')->name('moment.store');