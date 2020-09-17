<!-- hashlinks -->
<div class="row mb-2">
    <div class="col-12">
        @foreach($submenublog as $item)
            <a class="float-left ml-1 app-hashlink" href="{{$item->url_final}}">#{{strtolower($item->description)}}</a>
        @endforeach
    </div>
</div>
<!--/ hashlinks -->
