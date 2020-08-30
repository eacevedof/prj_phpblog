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

//Route::get('/', function () {return view('open/home');});
Route::get('/', ['as' => 'open.home', 'uses' => 'Open\HomeController']);
Route::get('/contact', ['as' => 'open.home.contact', 'uses' => 'Open\ContactController']);
Route::get('/aboutme', ['as' => 'open.home.aboutme', 'uses' => 'Open\AboutmeController']);
Route::get('/blog/{slug}', ['as' => 'open.blog.category', 'uses' => 'Open\BlogController@category']);
Route::get('/blog', ['as' => 'open.blog', 'uses' => 'Open\BlogController']);

