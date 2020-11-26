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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::view('scan', 'scan');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@welcome');
Route::get('/threads','ThreadsController@index')->name('threads');
Route::get('/threads/create', 'ThreadsController@create')->middleware('verified');
Route::get('/threads/search','SearchController@show');
Route::get('/threads/{channel}','ThreadsController@index');
Route::get('/threads/{channel}/{thread}', 'ThreadsController@show');
Route::patch('/threads/{channel}/{thread}', 'ThreadsController@update');

//Route::patch('/threads/{channel}/{thread}', 'ThreadsController@update')->name('threads.update');

Route::post('/locked-threads/{thread}', 'LockedThreadsController@store')
    ->name('locked-threads.store')
    ->middleware('admin');

Route::delete('/locked-threads/{thread}', 'LockedThreadsController@destroy')
    ->name('locked-threads.destroy')
    ->middleware('admin');

Route::delete('/threads/{channel}/{thread}', 'ThreadsController@destroy');
Route::post('/threads','ThreadsController@store')->middleware('verified');

Route::post('/threads/{channel}/{thread}/replies', 'RepliesController@store');
Route::get('/threads/{channel}/{thread}/replies', 'RepliesController@index');
Route::delete('/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');
Route::patch('/replies/{reply}', 'RepliesController@update');


Route::post('/replies/{reply}/best', 'BestRepliesController@store')->name('best-replies.store');


Route::post('/replies/{reply}/favorites', 'FavoritesController@store');
Route::delete('/replies/{reply}/favorites', 'FavoritesController@destroy');

Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');

Route::delete('/profiles/{user}/notifications/{notification}', 'UserNotificationsController@destroy');
Route::get('/profiles/{user}/notifications', 'UserNotificationsController@index');


Route::post('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@store')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscriptions', 'ThreadSubscriptionsController@destroy')->middleware('auth');

Route::get('test', function(){
    return view('test');
});

Route::resource('/editor', 'CKEditorController');

Route::post('ckeditor/image_upload', 'CKEditorController@upload')->name('upload');

Route::get('api/users', 'Api\UsersController@index');
Route::post('api/users/{user}/avatar', 'Api\UserAvatarController@store')->middleware('auth')->name('avatar');

Route::get('/test', function(){
    return view('test');
});

Route::get('/send', 'MailController@create');
Route::post('/send', 'MailController@store');

Route::get('/emails', 'EmailsController@index');
Route::post('/emails', 'EmailsController@store');

Route::get('/emails/{emails}', 'EmailsController@show');
Route::patch('/emails/{emails}', 'EmailsController@update');

Route::post('/import', 'EmailsController@import');
Route::post('/check', 'EmailsController@validateExel');
