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

Auth::routes();

Route::resource('users', 'UsersController',['only' => ['show','edit','update','index','destroy']]);

Route::resource('posts', 'PostsController',['only' => ['index','edit','update','create','destroy','store']]);
Route::post('/posts/upload_image','PostsController@uploadImage')->name('posts.upload_image');
Route::get('/contents/{cluster}/{post}','PostsController@show')->name('posts.show');

Route::get('/','PagesController@frontpage')->name('frontpage');

Route::get('/contents','ClusterController@index')->name('clusters.index');

Route::get('/contents/{currentCluster}','ClusterController@show')->name('clusters.show');
