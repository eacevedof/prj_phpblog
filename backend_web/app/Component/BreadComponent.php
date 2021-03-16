<?php
namespace App\Component;

class BreadComponent
{
/*
//paginas sueltas
Route::get('/', 'Open\HomeController')->name("open.home.index");;
Route::get('/contacto', 'Open\ContactController')->name("open.home.contact");
Route::get('/eduardo-acevedo-farje', 'Open\AboutmeController')->name("open.home.aboutme");

//blog
Route::get('/blog/search/{search}','Open\BlogController')->name("open.blog.search");
Route::get('/blog/{catslug}/{postslug}','Open\BlogController@detail')->name("open.blog.detail");
Route::get('/blog/{catslug}','Open\BlogController@category')->name("open.blog.category");
Route::get('/blog/','Open\BlogController')->name("open.blog.index");
*/
    private $breadscrumb = [
        "open.home.index"=>[],

        "open.home.contact"=>[
            ["url"=>"/contacto", "text"=>"Contacto"],
        ],
        "open.home.aboutme"=>[
            ["url"=>"/eduardo-acevedo-farje", "text"=>"Sobre mí"],
        ],

        "open.blog.index"=>[
            ["url"=>"/blog", "text"=>"Blog"],
        ],

        "open.blog.search"=>[
            ["url"=>"/blog", "text"=>"Blog"],
            ["url"=>"/blog/search", "text"=>"Blog search"],
        ],

        "open.blog.category"=>[
            ["url"=>"/blog", "text"=>"Blog"],
            ["url"=>"/blog/%category%/", "text"=>"%categorytext%"],
        ],

        "open.blog.detail"=>[
            ["url"=>"/blog", "text"=>"Blog"],
            ["url"=>"/blog/%category%/", "text"=>"%categorytext%"],
            ["url"=>"/blog/%category%/%slug%", "text"=>"%slugtext%"],
        ],

        "open.service.pdftojpg"=>[
            ["url"=>"/servicios/%slug%", "text"=>"%slugtext%"],
        ],
    ];

    private $found = [];

    private function _get_replaced($tag, $value, $text){return str_replace("%$tag%",$value,$text);}

    public function replace($replace=["category"=>"xxx","categorytext"=>"yyy"])
    {
        foreach ($this->found as $i => $arurl) {
            $url = $arurl["url"];
            $text = $arurl["text"];
            foreach ($replace as $tag => $value) {
                $url = $this->_get_replaced($tag, $value, $url);
                $text = $this->_get_replaced($tag, $value, $text);
            }

            $this->found[$i] = ["url" => $url, "text" => $text,];
        }

        return $this;
    }

    public function get_items($route)
    {
        $this->found = $this->breadscrumb[$route] ?? [];
        return $this;
    }

    public function get():array {return $this->found;}
}
