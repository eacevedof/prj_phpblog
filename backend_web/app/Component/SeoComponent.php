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

        "open.blog.index"=>[
            "title"=>"Eduardo A.F. Blog sobre desarrollo de software",
            "description"=>"Artículos sobre informatica. Temas de tecnología en general y software en particular",
            "keywords" => "PHP, Python, Javascript, Docker, Figma, Bash, PHP Storm, Visual studio Code",
            "h1" => ""
        ],

        "open.blog.category.php"=>[
            "title"=>"Eduardo A.F. Blog sobre PHP",
            "description"=>"Todo sobre el desarrollo en PHP. Php frameworks, snippets, Laravel, Yii, Symfony, herramientas, patrones de diseño",
            "keywords" => "PHP, Laravel, Symfony, Github, Composer",
            "h1" => ""
        ],

        "open.blog.category.python"=>[
            "title"=>"Eduardo A. F. Blog sobre Python",
            "description"=>"Todo sobre el desarrollo en Python. Python frameworks, snippets, Django, Flask, Selenium, herramientas de despliegue",
            "keywords" => "Python, Django, Flask, scripting, .py",
            "h1" => ""
        ],

        "open.blog.category.javascript"=>[
            "title"=>"Eduardo A. F. Blog sobre Javascript",
            "description"=>"Todo sobre el desarrollo en Javascript. Javascript frameworks, snippets, Vue, React, Svelte, programación funcional",
            "keywords" => "Programación funcional, Vue.js, React, Svelte, Vanilla Js",
            "h1" => ""
        ],

        "open.blog.category.sql"=>[
            "title"=>"Eduardo A. F. Blog sobre SQL",
            "description"=>"Todo sobre el lenguaje de consultas SQL en distintos motores de bases de datos relacionales, snippets, SQL Server, Mysql, Sqlite, programación T-SQL",
            "keywords" => "Procedimientos almacenados, vistas, indices, Mysql, SQL Server, Integration Services, stored procedures, triggers",
            "h1" => ""
        ],

        "open.blog.category.docker"=>[
            "title"=>"Eduardo A. F. Blog sobre Docker",
            "description"=>"Todo sobre el lenguaje de consultas SQL en distintos motores de bases de datos relacionales, snippets, SQL Server, Mysql, Sqlite, programación T-SQL",
            "keywords" => "Procedimientos almacenados, vistas, indices, Mysql, SQL Server, Integration Services, stored procedures, triggers",
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
        return self::$seo[$route] ?? [];
    }
}
