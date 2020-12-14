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

Route::post("/services/conversion/pdf-to-jpg","Open\ServiceController@pdftojpg_convert")->name("open.service.pdftojpgconvert");
Route::get("/servicios/convertir-pdf-a-jpg","Open\ServiceController@pdftojpg")->name("open.service.pdftojpg");

Route::post("/services/generate/password","Open\ServiceController@generate_password")->name("open.service.generate_password");
Route::get("/servicios/generar-contrasena","Open\ServiceController@generatepassword")->name("open.service.generatepassword");

Route::post("/services/test/pregmatchall","Open\ServiceController@pregmatch_all")->name("open.service.pregmatch_all");
Route::get("/servicios/probar-php-preg-match-all","Open\ServiceController@pregmatchall")->name("open.service.pregmatchall");

Route::post("/services/formatter/sql-query","Open\ServiceController@format_sql")->name("open.service.format_sql");
Route::get("/servicios/formatear-consulta-sql","Open\ServiceController@formatsql")->name("open.service.formatsql");

Route::post("/services/test/sslencrypt","Open\ServiceController@ssl_encrypt")->name("open.service.ssl_encrypt");
Route::get("/servicios/probar-ssl-encrypt","Open\ServiceController@sslencrypt")->name("open.service.sslencrypt");

Route::get("/servicios/reloj-alarma-online","Open\ServiceController@alarmclock")->name("open.service.alarmclock");

Route::get("/infrastructure/get-max-upload-size","Common\InfrastructureController@get_maxuploadsize")->name("open.service.getmaxuploadsize");

//language
Route::get("/idiomas/{subjslug}","Open\LanguageController@practice")->name("open.language.practice");
Route::get("/idiomas","Open\LanguageController")->name("open.language.index");

//vendor/laravel/ui/src/AuthRouteMethods.php donde están las rutas
Auth::routes();

//rutas ADM
Route::get('/adm', 'Restrict\AdminController')->name('restrict.admin');

//upload
Route::get('/adm/upload', 'Restrict\UploadController')->name('restrict.upload.index');
//Route::get('/adm/upload/insert', 'Restrict\UploadController@insert')->name('restrict.upload.insert');

//post
Route::get('/adm/posts', 'Restrict\PostController')->name('restrict.post.index');
Route::get('/adm/post/insert', 'Restrict\PostController@insert')->name('restrict.post.insert');
Route::get('/adm/post/update/{idpost}', 'Restrict\PostController@update')->name('restrict.post.update');
Route::get('/adm/post/detail/{idpost}', 'Restrict\PostController@detail')->name('restrict.post.detail');

//language subject
Route::get('/adm/language/subjects', 'Restrict\Language\SubjectController')->name('restrict.language.subject.index');
Route::get('/adm/language/subject/insert', 'Restrict\Language\SubjectController@insert')->name('restrict.language.subject.insert');
Route::get('/adm/language/subject/update/{idsubject}', 'Restrict\Language\SubjectController@update')->name('restrict.language.subject.update');
Route::get('/adm/language/subject/detail/{idsubject}', 'Restrict\Language\SubjectController@detail')->name('restrict.language.subject.detail');
Route::get("/adm/language/subject/{idsubject}/sentences",'Restrict\Language\SubjectController@sentences')->name('restrict.language.subject.sentences');
Route::get("/adm/language/subject/{idsubject}/sentence/insert",'Restrict\Language\SentenceController@insert')->name('restrict.language.sentence.insert');
Route::get("/adm/language/subject/{idsubject}/sentence/update/{idsentence}",'Restrict\Language\SentenceController@update')->name('restrict.language.sentence.update');

Route::get("/adm/language/subject/{idsubject}/sentence/{idsentence}/sentencetrs",'Restrict\Language\SentenceController@sentencetrs')->name('restrict.language.sentence.sentencetrs');
Route::get("/adm/language/sentence/{idsentence}/sentencetr/insert",'Restrict\Language\SentencetrController@insert')->name('restrict.language.sentence.sentencetr.insert');
Route::get("/adm/language/sentence/{idsentence}/sentencetr/update/{idsentencetr}",'Restrict\Language\SentencetrController@update')->name('restrict.language.sentence.sentencetr.update');

//language sentence


//API
Route::apiResource("/api/post/category","Api\CategoryController");
Route::apiResource("/api/post","Api\PostController");
Route::apiResource("/api/language/subject","Api\Language\SubjectController");
Route::apiResource("/api/language/subject/{idsubject}/sentences","Api\Language\SubjectSentenceController");
Route::apiResource("/api/language/sentence/{idsentence}/sentencetrs","Api\Language\SentenceSentencetrController");
Route::apiResource("/api/language/language","Api\Language\LanguageController");
Route::apiResource("/api/language/sentence","Api\Language\SentenceController");
Route::apiResource("/api/language/sentencetr","Api\Language\SentencetrController");
Route::apiResource("/api/language/sentenceattempt","Api\Language\SentenceattemptController");
Route::apiResource("/api/language/sentencetop","Api\Language\SentencetopController");

//picklists (solo lectura)
Route::get("/api/app-array/source","Api\ApparrayController@get_source");
Route::get("/api/app-array/lang-context","Api\ApparrayController@get_langcontext");
Route::get("/api/app-array/lang-type","Api\ApparrayController@get_langtype");
Route::get("/api/picklist/language","Api\Language\LanguageController@get_picklist");
Route::get("/api/language/subject/{idsubject}/sentenceattempts","Api\Language\SentenceattemptController@bysubject");
Route::get("/api/language/subject/{idsubject}/sentencetops","Api\Language\SentencetopController@bysubject");
