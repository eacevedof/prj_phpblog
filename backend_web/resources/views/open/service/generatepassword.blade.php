@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="card opn-card">
    <div class="card-header">
        <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
        <h6>Las contraseñas no se persisten y son totalmente aleatorias</h6>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-generate" class="row g-3">
            <div v-if="password" class="col-12">
                <pre class="alert-info align-content-center p-3"><b>{{password}}</b></pre>
            </div>
            <div class="col-sm-2">
                <label>
                    Tamaño:
                    <sub>min:8, max:16</sub>
                </label>
                <input type="number" class="form-control" required="required" min="8" max="16"
                    :disabled="issending"
                    v-model="length"
                />
            </div>
            <div class="col-sm-2">
                <label>
                    Excluir números:
                    <sub>separados por coma de 0 a 9</sub>
                </label>
                <input type="text" class="form-control" maxlength="17"
                       :disabled="issending"
                       v-model="nonumbers"
                />
            </div>
            <div class="col-sm-2">
                <label>
                    Excluir letras:
                    <sub>separadas por coma de: a,A - z,Z</sub>
                </label>
                <input type="text" class="form-control" maxlength="26"
                       :disabled="issending"
                       v-model="noletters"
                />
            </div>
            <div class="col-sm-3">
                <label>
                    Excluir caracteres especiales:
                    <sub>csv: @,#,$,%,&,...</sub>
                </label>
                <input type="text" class="form-control" maxlength="26"
                       :disabled="issending"
                       v-model="nochars"
                />
            </div>
            <!-- boton -->
            <div class="col-sm-2 m-0 p-0 pt-4">
                <button id="btn-generate" class="btn btn-dark m-0 mt-3" :disabled="issending" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-generatepassword.js"></script>
@endsection
