<?php
namespace App\Component;

class BreadComponent
{
/*
Route::get('/blog/search/{search}','Open\BlogController')->name("open.blog.search");
Route::get('/blog/{catslug}/{postslug}','Open\BlogController@detail')->name("open.blog.detail");
Route::get('/blog/{catslug}','Open\BlogController@category')->name("open.blog.category");
Route::get('/blog/','Open\BlogController')->name("open.blog.index");
*/
    private static $breadscrumb = [
        "home"=>[],

        "contact"=>[
            ["url"=>"/contacto", "text"=>"Contacto"],
        ],

        "open.blog.index"=>[
            ["url"=>"/blog", "text"=>"Blog"],
        ],


        "xxxx"=>[
            "title"=>"",
            "description"=>"",
            "keywords" => "",
            "h1" => ""
        ],
    ];

    public static function get_items($route)
    {
        return self::$breadscrumb[$route];
    }

}
