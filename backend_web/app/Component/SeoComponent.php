<?php
namespace App\Component;

class SeoComponent
{
    private static $seo = [
        "open.home.index"=>[
            "title"=>"Eduardo Acevedo F. | Fullstack developer",
            "description"=>"Blog con contenido sobre informática. Desarrollo de software, hardware y artículos relacionados con tecnología",
            "keywords" => "Programación, desarrollo de software, arquitectura, patrones de diseño, diseño gráfico, css, js, php, java, docker, python",
            "h1" => ""
        ],
        "open.home.contact"=>[
            "title"=>"Eduardo A. F. | Contacto",
            "description"=>"Formulario de contacto. Consultas, sugerencias, propuestas.",
            "keywords" => "contacto, consultas, dudas, sugerencias, propuestas",
            "h1" => ""
        ],
        "open.blog.index"=>[
            "title"=>"Eduardo A.F. | Blog ",
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
        "open.service.pdftojpg" => [
            "title"=>"Servicio online para convertir pdf a jpg",
            "description"=>"Convierte las páginas de un documento PDF en imágenes separadas .jpg",
            "keywords" => "conversor, pdf, jpg",
            "h1" => "Servicio online. Convierte pdf a jpg"
        ],
        "open.language.index"=>[
            "title"=>"Aplicación Idiomas - Temario",
            "description"=>"Aplicación para aprender idiomas. Temario de prácticas online. Traducir palabras y frases",
            "keywords" => "Practíca un idioma, inglés, frances, español, neerlandes, etc",
            "h1" => ""
        ],
        "open.language.practice"=>[
            "title"=>"Práctica del tema \"%s\"",
            "description"=>"Configura y comienza a practicar traduciendo al idioma que elijas",
            "keywords" => "Traduce, español, ingles, frances, neerlandes, etc",
            "h1" => ""
        ],
        "open.service.generatepassword"=>[
            "title"=>"Generador de contraseñas seguras",
            "description"=>"Crea una contraseña segura combinando letras, números y caracteres especiales",
            "keywords" => "Contraseña, clave, password, acceso seguro, letras, números y caractreres especiales",
            "h1" => ""
        ],
        "open.service.pregmatchall"=>[
            "title"         => "Probar la función de php pregmatch_all",
            "description"   => "Configura el patrón a aplicar, los flags y el texto a tratar",
            "keywords"      => "php, pregmatch_all, probar, resultado",
            "h1"            => ""
        ],
        "open.service.formatsql"=>[
            "title"         => "Formatea una consulta SQL",
            "description"   => "A partir de una consulta SQL la organiza con saltos de linea alienado joins, where, etc",
            "keywords"      => "Formatear, sql, indentación, alinear",
            "h1"            => ""
        ],
        "open.service.alarmclock"=>[
            "title"         => "Alarma online",
            "description"   => "Configura una alarma que emitirá un sonido según el intervalo configurado",
            "keywords"      => "alarma, reloj, js, sonido, reproducir sonido",
            "h1"            => ""
        ],
        "open.service.oensslencrypt"=>[
            "title"         => "Probar la función de php openssl_encrypt para cifrar y descifrar un contenido",
            "description"   => "Define un hash y el método de cifrado",
            "keywords"      => "php, opnessl_encrypt, probar, resultado",
            "h1"            => ""
        ],
        "open.service.sitevulnerability"=>[
            "title"         => "Comprueba que tan vulnerable es tu sitio",
            "description"   => "Utilizando una colección de exploits recurrentes se escanea tu dominio",
            "keywords"      => "Vulnerabilidad, seguridad, dominios, wordpress, ataques",
            "h1"            => ""
        ]
    ];

    private const EMPTY = [
        "title"=>"",
        "description"=>"",
        "keywords" => "",
        "h1" => ""
    ];

    public static function get_meta($route)
    {
        return self::$seo[$route] ?? self::EMPTY;
    }
}
