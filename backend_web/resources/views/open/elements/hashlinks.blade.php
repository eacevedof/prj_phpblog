
<!-- hashlinks -->
<div class="row mb-2">
    <div class="col-12">
        @foreach($submenublog as $item)
            <a class="badge bg-success float-left ml-1 opn-hashlink" href="{{$item->url_final}}">#{{strtolower($item->description)}}</a>
        @endforeach
    </div>
</div>
<!--/ hashlinks -->
