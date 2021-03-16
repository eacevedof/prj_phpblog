@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])
@section("canonical",$canonical ?? "")

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
                <textarea class="form-control" maxlength="100000" rows="10"
                          style="font-family: 'Courier New'; font-size: smaller; border:1px solid #00B7FF!important;"
                       :disabled="issending"
                       v-model="query"
                ></textarea>
            </div>
            <!-- boton -->
            <div class="col-1">
                <button id="btn-formatsql" class="btn btn-dark mt-4" :disabled="issending" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div v-if="query" class="col-1 pl-4">
                <button type="button" id="btn-reset" class="btn btn-danger mt-4" :disabled="issending" v-on:click="reset">
                    <i class="fa fa-eraser"></i>
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div v-if="result" class="col-12">
                <label><b>Resultado:</b> <span style="color: #00B7FF; cursor: pointer;"><i class="fa fa-clipboard" v-on:click="to_clipboard"></i></span></label>
                <br/><br/>
                <pre style="font-size: 0.7rem; border: 1px solid #ccc">{{result}}</pre>
                <label class="float-right"><span style="color: #00B7FF; cursor: pointer"><i class="fa fa-clipboard" v-on:click="to_clipboard"></i></span></label>
            </div>
        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-formatsql.js"></script>
@endsection
