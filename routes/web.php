<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/news');
Route::middleware('auth')
    ->group(function (){
        //site Routers
        Route::get('/news', 'SiteController@news')->name('news');

        //Model Routers
        Route::resource('/user','UserController')->except('edit','update','store', 'destroy');
        Route::resource('/post', 'PostController');
        Route::resource('/comment', 'MessageController')->except('index', 'show', 'create', 'store', 'edit');

        //Comment(Message) Routers
        Route::post('/comment/{post}', 'MessageController@store')->name('comment.store');
        Route::get('/comment/{message}', 'MessageController@edit')->name('comment.edit');

        //Friend Routers
        Route::post('/user/{user}/befriend','UserController@befriend')->name('user.befriend');
        Route::delete('/user/{user}/unfriend','UserController@removeFriend')->name('friend.destroy');
        Route::get('/user/{user}/denyFriend', 'UserController@denyFriend')->name('user.denyFriend');
        Route::get('/user/{user}/acceptFriend', 'UserController@acceptFriend')->name('user.acceptFriend');
        Route::get('/user/friends/{user}','UserController@viewFriend')->name('user.friends');



    });
