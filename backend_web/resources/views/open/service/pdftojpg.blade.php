@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])
@section("canonical",$canonical ?? "")

@section("container")
<div class="card opn-card">
    <div class="card-header">
        <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-convert" class="row g-3">
            <div class="col-sm-9">
                <label for="name">PDF *</label>
                <input type="file" class="form-control" required="required"
                       :disabled="issending"
                       accept="application/pdf"
                       ref="inputfile"
                       @change="on_change"
                >
            </div>
            <!-- boton -->
            <div class="col-sm-3 m-0 p-0 pt-4">
                <button id="btn-contact" class="btn btn-dark m-0 mt-3" :disabled="issending || isoversized" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>

            <div class="d-flex m-0 mt-1 pl-3" style="flex-wrap: wrap;">
                <small class="badge bg-info text-white">Tamaño máximo: {{maxuploadsize.toLocaleString("en")}}</small>
                <small v-if="filessize>0" class="badge bg-warning">Tamaño archivo: {{filessize.toLocaleString("en")}}</small>
                <small v-if="isoversized" class="badge bg-danger text-white">Exceso: {{overbytes.toLocaleString("en")}}</small>
            </div>
            <div v-if="link!=''" class="col-sm-12">
                <span>Tus imágenes:</span>
                <a class="link-success" target="_blank"
                   :href="link"
                >Descargar</a>
            </div>
        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-pdftojpg.js"></script>
@endsection
