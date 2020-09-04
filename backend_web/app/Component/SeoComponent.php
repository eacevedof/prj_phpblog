<?php
namespace App\Component;

class SeoComponent
{
    private static $seo = [
        "home"=>[
            "title"=>"Blog de Eduardo",
            "description"=>"Contenido sobre informática. Desarrollo de software, hardware y diseño gráfico ",
            "keywords" => "Programación, desarrollo de software, diseño, css, js, php, java, docker, python",
            "h1" => ""
        ],

        "xxxx"=>[
            "title"=>"",
            "description"=>"",
            "keywords" => "",
            "h1" => ""
        ],
    ];

    public static function get_meta($route)
    {
        return self::$seo[$route];
    }
}
