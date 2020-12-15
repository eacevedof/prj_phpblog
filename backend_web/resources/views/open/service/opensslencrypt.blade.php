@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="card opn-card" xmlns="http://www.w3.org/1999/html">
    <div class="card-header">
        <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
        <h6>Prueba php <a class="btn-link" href="https://www.php.net/manual/es/function.preg-match-all.php" target="_blank" rel="nofollow"><b>preg_match_all</b></a></h6>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-opensslencrypt">
            <div class="row">
                <pre class="alert-info p-3"><b>{{final}}</b>    <i v-if="pattern" class="fa fa-clipboard" v-on:click="to_clipboard"></i></pre>
            </div>
            <div class="row">
                <div class="col-3">
                    <label>
                        Metod: AES-256-CBC
                    </label>
                    <input type="text" class="form-control" required="required" max="500"
                           ref="pattern"
                           :disabled="issending"
                           v-model="pattern"
                           v-on:keyup="update_final"
                    />
                </div>
                <div class="col-3">
                    <label>
                        https://www.php.net/manual/es/function.openssl-get-cipher-methods.php
                        iv <small>Vector de inicialización</small>
                    </label>
                    <input type="text" class="form-control" required="required" max="500"
                           ref="pattern"
                           :disabled="issending"
                           v-model="pattern"
                           v-on:keyup="update_final"
                    />
                </div>
                <div class="col-4">
                    <label>
                        Flags:
                        <sub>ejemplo: imsx</sub>
                    </label>
                    <input type="text" class="form-control" maxlength="4"
                           :disabled="issending"
                           v-model="flags"
                           v-on:keyup="update_final"
                    />
                </div>
                <div class="col-10">
                    <label>Texto:</label>
                    <textarea class="form-control" maxlength="10000" rows="8"
                              :disabled="issending"
                              v-model="text"
                    ></textarea>
                </div>
                <!-- boton -->
                <div class="col-2">
                    <button id="btn-opensslencrypt" class="btn btn-dark m-0 mt-3" :disabled="issending" >
                        {{btnsend}}
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
                <div v-if="result" class="col-12">
                    <label><b>Resultado:</b></label><br/>
                    <pre style="font-size: 0.7rem; border: 1px solid #ccc">{{result}}</pre>
                </div>
            </div>
            <div class="row">

            </div>

        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-opensslencrypt.js"></script>
@endsection
