@php
$requrl = Request::url();
$arurls = [
    ["href"=>"/adm/language/subject/update/$idsubject","text"=>"Update","isactive"=>true],
    ["href"=>"/adm/language/subject/$idsubject/sentences","text"=>"Sentences","isactive"=>false]
];
@endphp
<ul class="nav nav-tabs">
    @foreach($arurls as $url)
    <li class="nav-item">
        <a class="nav-link {{ $url["isactive"] ? "active" : "" }}" href="{{$url["href"]}}">{{$url["text"]}}</a>
    </li>
    @endforeach
</ul>
