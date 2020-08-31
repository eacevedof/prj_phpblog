<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ['as' => 'open.home', 'uses' => 'Open\HomeController']);
Route::get('/contacto', ['as' => 'open.home.contact', 'uses' => 'Open\ContactController']);
Route::get('/eduardo-acevedo-farje', ['as' => 'open.home.aboutme', 'uses' => 'Open\AboutmeController']);
Route::get('/blog/{slug}', ['as' => 'open.blog.category', 'uses' => 'Open\BlogController@category']);
Route::get('/blog', ['as' => 'open.blog', 'uses' => 'Open\BlogController']);


//vendor/laravel/ui/src/AuthRouteMethods.php donde están las rutas
Auth::routes();

Route::get('/adm', 'Restrict\AdminController')->name('restrict.admin');
//post
Route::get('/adm/posts', 'Restrict\PostController')->name('restrict.post.index');
Route::get('/adm/post/insert', 'Restrict\PostController@insert')->name('restrict.post.insert');
Route::get('/adm/post/update/{idpost}', 'Restrict\PostController@update')->name('restrict.post.update');
Route::get('/adm/post/detail/{idpost}', 'Restrict\PostController@detail')->name('restrict.post.detail');
Route::get('/adm/post/delete/{idpost}', 'Restrict\PostController@delete')->name('restrict.post.delete');
