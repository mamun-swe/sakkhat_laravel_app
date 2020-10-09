<?php

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// Post Routes
Route::resource('post', 'PostController')->middleware('auth');

// Profile Routes
Route::get('show-profile/{id?}', 'ProfileController@index')->name('profile.show')->middleware('auth');
Route::get('edit-profile/{id?}', 'ProfileController@edit')->name('profile.edit')->middleware('auth');
Route::put('update-profile-image/{id?}', 'ProfileController@updateProfilePic')->name('profile.update.image')->middleware('auth');
Route::put('update-profile-cover/{id?}', 'ProfileController@updateCoverPic')->name('profile.update.cover')->middleware('auth');

// About Routes
Route::get('about', 'AboutController@index')->name('about.index')->middleware('auth');
Route::get('about-create', 'AboutController@create')->name('about.create')->middleware('auth');
Route::post('about-store', 'AboutController@store')->name('about.store')->middleware('auth');
Route::get('about/{id}/edit', 'AboutController@edit')->name('about.edit')->middleware('auth');
Route::put('about/{id}/update', 'AboutController@update')->name('about.update')->middleware('auth');
// Route::get('about/{id}/show', 'AboutController@show')->name('about.show')->middleware('auth');

// Friend Routes
Route::get('friends', 'FriendController@index')->name('friend.index')->middleware('auth');
Route::post('send-request/{id}', 'FriendController@sendRequest')->name('request.send')->middleware('auth');
Route::post('accept-request/{id}', 'FriendController@acceptRequest')->name('request.accept')->middleware('auth');
Route::post('cancel-request/{id}', 'FriendController@cancelRequest')->name('request.cancel')->middleware('auth');

// Chat Routes
Route::get('/chat', 'ChatController@index')->name('chat.index')->middleware('auth');
Route::get('/chatting/{id}', 'ChatController@goChat')->name('chat.message')->middleware('auth');
Route::post('sent-message', 'ChatController@sentMessage')->name('message.sent')->middleware('auth');

// Comments Routes
Route::post('/comment-make', 'CommentController@createComment')->name('comment.create')->middleware('auth');
Route::get('/show-comment/{id}', 'CommentController@getComments')->name('comment.get')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
