@php
$requrl = Request::url();
$arurls = [
    ["href"=>"/adm/language/subject/update/$idsubject","text"=>"Update","isactive"=>strstr($requrl,"/update/")],
    ["href"=>"/adm/language/subject/$idsubject/sentences","text"=>"Sentences","isactive"=>strstr($requrl,"/sentences")]
];
@endphp
<ul class="nav nav-tabs">
    @foreach($arurls as $url)
    <li class="nav-item">
        <a class="nav-link {{ $url["isactive"] ? "active" : "" }}" href="{{$url["href"]}}">{{$url["text"]}}</a>
    </li>
    @endforeach
</ul>
