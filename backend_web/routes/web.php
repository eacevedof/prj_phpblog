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
Route::get('/blog/draft/{id}','Open\BlogController@detail_draft')->name("open.blog.detaildraft");
Route::get('/blog/search/{search}','Open\BlogController')->name("open.blog.search");
Route::get('/blog/{catslug}/{postslug}','Open\BlogController@detail')->name("open.blog.detail");
Route::get('/blog/{catslug}','Open\BlogController@category')->name("open.blog.category");
Route::get('/blog/','Open\BlogController')->name("open.blog.index");

Route::post('/email/contact', "Common\Email\EmailController@contact")->name("common.email.contact");
Route::post("/services/conversion/pdf-to-jpg","Open\ServiceController@pdftojpg_convert")->name("open.blog.service.pdftojpgconvert");
Route::get("/servicios/convertir-pdf-a-jpg","Open\ServiceController@pdftojpg")->name("open.blog.service.pdftojpg");
Route::get("/infrastructure/get-max-upload-size","Common\InfrastructureController@get_maxuploadsize")->name("open.blog.service.pdftojpg");


//vendor/laravel/ui/src/AuthRouteMethods.php donde están las rutas
Auth::routes();

//rutas ADM
Route::get('/adm', 'Restrict\AdminController')->name('restrict.admin');

//upload
Route::get('/adm/upload', 'Restrict\UploadController')->name('restrict.upload.index');
Route::get('/adm/upload/insert', 'Restrict\UploadController@insert')->name('restrict.upload.insert');

//post
Route::get('/adm/posts', 'Restrict\PostController')->name('restrict.post.index');
Route::get('/adm/post/insert', 'Restrict\PostController@insert')->name('restrict.post.insert');
Route::get('/adm/post/update/{idpost}', 'Restrict\PostController@update')->name('restrict.post.update');
Route::get('/adm/post/detail/{idpost}', 'Restrict\PostController@detail')->name('restrict.post.detail');

Route::apiResource("api/post/category","Api\CategoryController");
Route::apiResource("api/post","Api\PostController");
