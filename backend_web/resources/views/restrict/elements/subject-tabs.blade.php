@isset($idsubject)
@php
$requrl = Request::url();
$arurls = [
    ["href"=>"/adm/language/subject/update/$idsubject","text"=>"Subject","isactive"=>strstr($requrl,"/subject/update/")],
    ["href"=>"/adm/language/subject/$idsubject/sentences","text"=>"Subject/Sentences","isactive"=>strstr($requrl,"/sentences")],
];
if(strstr($requrl,"/insert")) $arurls[] =["href"=>"#","text"=>"Subject/Insert sentence","isactive"=>true];
if(strstr($requrl,"/sentence/update")) $arurls[] =["href"=>"#","text"=>"Subject/Update sentence","isactive"=>true];

@endphp
<ul class="nav nav-tabs">
    @foreach($arurls as $url)
    <li class="nav-item">
        <a class="nav-link {{ $url["isactive"] ? "active" : "" }}" href="{{$url["href"]}}">{{$url["text"]}}</a>
    </li>
    @endforeach
</ul>
@endisset
