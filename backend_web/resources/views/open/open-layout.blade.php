<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield("pagetitle")</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta id="meta-csrf-token" name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="@yield("pagedescription")" />
    <meta name="keywords" content="@yield("pagekeywords")" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- tpas -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta http-equiv="Content-Language" content="es_ES">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="author" content="Eduardo Acevedo F"/>
    <meta name="Distribution" content="Global"/>
    <meta name="Rating" content="General"/>
    <meta name="security" content="public" />
    <meta http-equiv="Cache-Control" content="s-maxage = 3600, max-age = 60, private" />


    <link rel="icon" type="image/png" href="https://resources.theframework.es/eduardoaf.com/20200917/161342-favicon.ico" />
<!--
    open graph protocol
    <meta property="og:title" content=" same as title" />
    <meta property="og:description" content=" same as desc" />
    <meta property="og:locale" content="es_ES" />
    <meta property="og:url" content="https://www.eduardoaf.com//s" />
	<meta property="og:site_name" content="www.eduardoaf.com" />

    <link rel="shortcut icon" href="/img/favicon.ico">
    <link rel="apple-touch-icon" href="/img/apple_icons_57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple_icons_72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple_icons_114x114.png">

    canonical:
	<link rel="next" href="https://www.eduardoaf.com//s/2" />
    <link rel="canonical" href="https://www.eduardoaf.com/s" />

    Robots:
    <meta name="robots" content="noindex,follow"/>
-->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- EnlighterJS Resources !-->
    <link href="{{ asset('assets/enlighter/enlighterjs.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/open.css') }}" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@include("common.elements.gtag")
</head>
<body>
@include("open.elements.navbar")
<main role="main">
    @isset($jumbotron)
        @include("open.elements.jumbotron")
    @endisset
    <div class="album py-5 bg-light">
        <div class="container">
            <span id="span-top"></span>
            @isset($breadscrumb)
                @include("open.elements.breadscrumb")
            @endisset
            @yield("container")
        </div>
    </div>
</main>
@include("open.elements.footer")
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@include("common.elements.enlighterjs")
@include("common.elements.totop")
</body>
</html>
