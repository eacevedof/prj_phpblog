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

//paginas sueltas
Route::get('/', 'Open\HomeController')->name("open.home.index");;
Route::get('/contacto', 'Open\ContactController')->name("open.home.contact");
Route::get('/eduardo-acevedo-farje', 'Open\AboutmeController')->name("open.home.aboutme");

//blog
Route::get('/blog/search/{search}','Open\BlogController')->name("open.blog.search");
Route::get('/blog/{catslug}/{postslug}','Open\BlogController@detail')->name("open.blog.detail");
Route::get('/blog/{catslug}','Open\BlogController@category')->name("open.blog.category");
Route::get('/blog/','Open\BlogController')->name("open.blog.index");

Route::post('/email/contact', "Common\Email\EmailController@contact")->name("common.email.contact");
//vendor/laravel/ui/src/AuthRouteMethods.php donde están las rutas
Auth::routes();

//rutas ADM
Route::get('/adm', 'Restrict\AdminController')->name('restrict.admin');

//post
Route::get('/adm/posts', 'Restrict\PostController')->name('restrict.post.index');
Route::get('/adm/post/insert', 'Restrict\PostController@insert')->name('restrict.post.insert');
Route::get('/adm/post/update/{idpost}', 'Restrict\PostController@update')->name('restrict.post.update');
Route::get('/adm/post/detail/{idpost}', 'Restrict\PostController@detail')->name('restrict.post.detail');

Route::apiResource("api/post","Api\PostController");
