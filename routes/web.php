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

// Auth
Auth::routes();
// UsersController
Route::resource('users', 'UsersController', ['only' => ['show', 'edit', 'update', 'index', 'destroy']]);
// PostsController
Route::resource('posts', 'PostsController', ['only' => ['index', 'edit', 'update', 'create', 'destroy', 'store']]);
Route::post('/posts/upload_image', 'PostsController@uploadImage')->name('posts.upload_image');
Route::get('/contents/{cluster}/{post}', 'PostsController@show')->name('posts.show');
// PagesController
Route::get('/', 'PagesController@frontpage')->name('frontpage');
// ClusterController
Route::get('/contents', 'ClusterController@index')->name('clusters.index');
Route::get('/contents/{currentCluster}', 'ClusterController@show')->name('clusters.show');
// AnswersController
Route::resource('/answers', 'AnswersController', ['only' => ['store','index']]);
Route::get('/answers/{cluster}/{post}','AnswersController@show')->name('answers.show');
// ModulesController
Route::resource('/modules', 'ModulesController', ['only' => ['store', 'edit', 'update','destroy']]);
// SurveyController
Route::resource('/surveys','SurveysController',['only' => ['index','show','create','store','edit','update','destroy']]);
