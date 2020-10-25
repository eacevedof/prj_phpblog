@isset($idsubject)
@php
$requrl = Request::url();
$arurls = [
    ["href"=>"/adm/language/subject/update/$idsubject","text"=>"Subject","isactive"=>strstr($requrl,"/subject/update/")],
    ["href"=>"/adm/language/subject/$idsubject/sentences","text"=>"Sentences","isactive"=>strstr($requrl,"/sentences")],
];

if(strstr($requrl,"/sentence/insert"))
    $arurls[] =["href"=>"/adm/language/subject/$idsubject/sentence/insert","text"=>"Insert sentence","isactive"=>true];

if(isset($idsentence)) {
    $arurls[] =["href"=>"/adm/language/subject/$idsubject/sentence/update/$idsentence","text"=>"Update sentence","isactive"=>strstr($requrl,"/sentence/update/")];
    $arurls[] =["href"=>"/adm/language/subject/$idsubject/sentence/$idsentence/sentencetrs","text"=>"Sentence TRS","isactive"=>strstr($requrl,"$idsentence/sentencetrs")];
    if(strstr($requrl,"/sentencetr/insert"))
        $arurls[] =["href"=>"/adm/language/sentence/$idsentence/sentencetr/insert","text"=>"Insert TR","isactive"=>true];
}


@endphp
<ul class="nav nav-tabs">
    @foreach($arurls as $url)
    <li class="nav-item">
        <a class="nav-link {{ $url["isactive"] ? "active" : "" }}" href="{{$url["href"]}}">{{$url["text"]}}</a>
    </li>
    @endforeach
</ul>
@endisset
