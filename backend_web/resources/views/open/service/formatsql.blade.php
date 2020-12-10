@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="card opn-card" xmlns="http://www.w3.org/1999/html">
    <div class="card-header">
        <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-formatsql" class="row g-3">
            <div class="col-10">
                <label>SQL:</label>
                <textarea class="form-control" maxlength="10000" rows="8"
                          style="font-family: 'Courier New'; font-size: smaller; border:1px solid #00B7FF!important;"
                       :disabled="issending"
                       v-model="query"
                ></textarea>
            </div>
            <!-- boton -->
            <div class="col-2">
                <button id="btn-formatsql" class="btn btn-dark m-0 mt-3" :disabled="issending" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div v-if="result" class="col-12">
                <label><b>Resultado:</b> <span style="color: #00B7FF"><i class="fa fa-clipboard" v-on:click="to_clipboard"></i></span></label>
                <br/><br/>
                <pre style="font-size: 0.7rem; border: 1px solid #ccc">{{result}}</pre>
            </div>
        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-formatsql.js"></script>
@endsection
