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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('channels', 'ChannelController');

Route::get('videos/{video}', 'VideoController@show')->name('video.show');
Route::put('videos/{video}', 'VideoController@updateViews')->name('video.updateViews');
Route::get('videos/{video}/comments', 'CommentController@index')->name('video.comments.index');
Route::get('comments/{comment}/replies', 'CommentController@show')->name('video.comment.show');
Route::put('videos/{video}/update', 'VideoController@update')->name('video.update')->middleware(['auth']);


Route::middleware(['auth'])
    ->group(function(){
        Route::post('comments/{video}', 'CommentController@store')->name('video.comment.store');
        Route::post('votes/{entityId}/{type}', 'VoteController@vote');
        Route::post('channels/{channel}/videos', 'UploadVideoController@store');
        Route::get('channels/{channel}/videos', 'UploadVideoController@index')->name('channel.upload');
        Route::resource('channels/{channel}/subscriptions', 'SubscriptionController')->only(['store', 'destroy']);
    });
