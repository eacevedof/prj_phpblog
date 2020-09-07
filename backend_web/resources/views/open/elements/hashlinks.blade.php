<div class="row mb-2">
    <div class="col-12">
        @foreach($submenublog as $item)
            <a class="float-left ml-1 app-hashlink" href="{{$item->slug}}">#{{strtolower($item->description)}}</a>
        @endforeach
    </div>
</div>
