@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="card opn-card" xmlns="http://www.w3.org/1999/html">
    <div class="card-header">
        <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
        <h6>Prueba php <b>preg_match_all</b></h6>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-pregmatchall" class="row g-3">
            <div v-if="pattern" class="col-12">
                <pre class="alert-info p-3"><b>{{final}}</b>     <i class="fa fa-clipboard" v-on:click="to_clipboard"></i></pre>
            </div>
            <div class="col-4">
                <label>
                    Patrón:
                    <sub>^(hola)</sub>
                </label>
                <input type="text" class="form-control" required="required" max="500"
                    :disabled="issending"
                    v-model="pattern"
                    v-on:keyup="update_final"
                />
            </div>
            <div class="col-4">
                <label>
                    Flags:
                    <sub>ejemplo: sim</sub>
                </label>
                <input type="text" class="form-control" maxlength="200"
                       :disabled="issending"
                       v-model="flags"
                       v-on:keyup="update_final"
                />
            </div>
            <!-- boton -->
            <div class="col-2 m-0 p-0 pt-4">
                <button id="btn-pregmatchall" class="btn btn-dark m-0 mt-3" :disabled="issending" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div class="col-12">
                <label>Texto:</label>
                <textarea class="form-control" maxlength="10000"
                       :disabled="issending"
                       v-model="text"
                ></textarea>
            </div>
            <div class="col-12">
                <label>
                    Resultado:
                </label>
                <div>{{result}}</div>
            </div>
            <div class="col-12">
            </div>
        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-pregmatchall.js"></script>
@endsection
