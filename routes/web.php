<?php

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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// Post Controller
Route::resource('post', 'PostController')->middleware('auth');
// Profile Controllers
Route::get('show-profile/{id?}', 'ProfileController@index')->name('profile.show')->middleware('auth');
Route::get('edit-profile/{id?}', 'ProfileController@edit')->name('profile.edit')->middleware('auth');
Route::put('update-profile-image/{id?}', 'ProfileController@updateProfilePic')->name('profile.update.image')->middleware('auth');
Route::put('update-profile-cover/{id?}', 'ProfileController@updateCoverPic')->name('profile.update.cover')->middleware('auth');
// Friend Controllers
// Route::get('suggested-friends', 'FriendController@suggestedFriends')->name('friend.suggested')->middleware('auth');
// Route::get('add-friend/{id?}', 'FriendController@addFriend')->name('friend.add')->middleware('auth');
// Route::get('all-friend', 'FriendController@allFriends')->name('friend.list')->middleware('auth');
// Route::get('friend-request', 'FriendController@friendRequests')->name('friend.request')->middleware('auth');
// Route::get('request-accept/{id}', 'FriendController@acceptRequest')->name('request.accept')->middleware('auth');

Route::get('friends', 'FriendController@index')->name('friend.index')->middleware('auth');
Route::post('send-request/{id}', 'FriendController@sendRequest')->name('request.send')->middleware('auth');
Route::post('cancel-request/{id}', 'FriendController@cancelRequest')->name('request.cancel')->middleware('auth');


// Chat Controllers
Route::get('/chat', 'ChatController@index')->name('chat.index')->middleware('auth');
Route::get('/chatting/{id}', 'ChatController@goChat')->name('chat.message')->middleware('auth');
Route::post('sent-message', 'ChatController@sentMessage')->name('message.sent')->middleware('auth');
Route::get('show-message/{id}', 'ChatController@showMessage')->name('message.show')->middleware('auth');
// Comments controllers
Route::post('/comment-make', 'CommentController@createComment')->name('comment.create')->middleware('auth');
Route::get('/show-comment/{id}', 'CommentController@getComments')->name('comment.get')->middleware('auth');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();