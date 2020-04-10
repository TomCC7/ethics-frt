<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// PagesController
Route::get('/', 'PagesController@frontpage')->name('frontpage');

// Auth
Auth::routes();

// UsersController
Route::resource('/users', 'UsersController', ['only' => ['show', 'edit', 'update', 'index', 'destroy']]);
Route::patch('/users/{user}/setAdmin', 'UsersController@setAdmin')->name('users.setAdmin');

// ClustersController
Route::resource('/contents', 'ClustersController', ['only' => ['index', 'store', 'update', 'destroy']]);
Route::get('/contents/{cluster}', 'ClustersController@show')->name('clusters.show');

// PostsController
Route::resource('/posts', 'PostsController', ['only' => ['index', 'edit', 'update', 'create', 'destroy', 'store']]);
Route::post('/posts/upload_image', 'PostsController@uploadImage')->name('posts.upload_image');
Route::get('/contents/{cluster}/{post}', 'PostsController@show')->name('posts.show');

// AnswersController
Route::resource('/answers', 'AnswersController', ['only' => ['index']]);
Route::get('/answers/{cluster}/{post}', 'AnswersController@show')->name('answers.show');
Route::put('/answers/{post}', 'AnswersController@storeOrUpdate')->name('answers.store');
// AnswersDownloadController
Route::post('/answers/download','AnswersDownloadController@download')->name('answers.download');
// ModulesController
Route::resource('/modules', 'ModulesController', ['only' => ['store', 'edit', 'update', 'destroy']]);
// SearchController
Route::get('/searches/user','SearchesController@user')->name('users.search');
