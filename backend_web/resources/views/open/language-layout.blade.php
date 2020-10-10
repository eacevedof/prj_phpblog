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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>
    <link href="{{ asset('css/common.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/language.css') }}" rel="stylesheet" />
</head>
<body>
@include("open.elements.bulma.navbar")
@yield("container")
@include("open.elements.bulma.footer")
</body>
</html>
