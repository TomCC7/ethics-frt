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

Route::resource('posts', 'PostsController',['only' => ['show','index','edit','update','create','destroy','store']]);
Route::post('/posts/upload_image','PostsController@uploadImage')->name('posts.upload_image');

Route::get('/','PagesController@frontpage')->name('frontpage');

Route::get('/contents','ClusterController@list')->name('cluster-list');
Route::get('/contents/clusters/{clusterID}','PostsController@list')->name('post-list');

