@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
<div class="card opn-card" xmlns="http://www.w3.org/1999/html">
    <div class="card-header">
        <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
        <h6>
            Prueba php
            <a class="btn-link" href="https://www.php.net/manual/es/function.openssl-encrypt.php" target="_blank" rel="nofollow"><b>openssl_encrypt</b></a> y
            <a class="btn-link" href="https://www.php.net/manual/es/function.openssl-decrypt.php" target="_blank" rel="nofollow"><b>openssl_decrypt</b></a>
        </h6>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-opensslencrypt">
            <div class="row">
<pre>
openssl_encrypt ( string $data , string $method , string $password [, int $options = 0 [, string $iv = "" ]] ) : string
openssl_decrypt ( string $data , string $method , string $password [, int $options = 0 [, string $iv = "" ]] ) : string
</pre>
            </div>
            <div class="row">
                <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                    <label>Función:</label>
                    <select v-model="func" class="form-control" required>
                        <option value="openssl_encrypt">openssl_encrypt</option>
                        <option value="openssl_decrypt">openssl_decrypt</option>
                    </select>
                </div>
                <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                    <label>Methods:</label>
                    <select v-model="method" class="form-control" required>
                        <option disabled value="">Seleccione un elemento</option>
                        <option v-for="(meth, i) in methods" :value="meth" :key="i">{{meth}}</option>
                    </select>
                </div>

                <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                    <label>Password:</label>
                    <input type="text" class="form-control" required="required" max="500"
                           ref="password"
                           :disabled="issending"
                           v-model="password"
                           @focus="$event.target.select()"
                    />
                </div>
                <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                    <label>Sal:</label>
                    <input type="text" class="form-control" max="500"
                           :disabled="issending"
                           v-model="salt"
                    />
                </div>
            </div>
            <div class="row ">
                <div class="col-2">
                    <label>Option </label>
                    <select v-model="option" class="form-control" required>
                        <option value="OPENSSL_NONE">NONE</option>
                        <option value="OPENSSL_RAW_DATA">OPENSSL_RAW_DATA</option>
                        <option value="OPENSSL_ZERO_PADDING">OPENSSL_ZERO_PADDING</option>
                    </select>
                </div>
                <div class="col-3">
                    <label>
                        iv <small>Vector de inicialización</small>
                    </label>
                    <input type="text" class="form-control" max="500"
                           ref="iv"
                           :disabled="issending"
                           v-model="iv"
                    />
                </div>

<!-- boton -->
                <div class="col-2">
                    <button id="btn-opensslencrypt" class="btn btn-dark m-0 mt-3" :disabled="issending" >
                        {{btnsend}}
                        <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <label>Datos:</label>
                    <textarea class="form-control" maxlength="10000" rows="8" required
                              :disabled="issending"
                              v-model="data"
                    ></textarea>
                </div>
                <div v-if="result" class="col-6">
                    <label><b>Resultado:</b></label><br/>
                    <p style="font-family:'Courier New', Courier, 'Lucida Sans Typewriter', 'Lucida Typewriter', monospace;"
                    >{{result}}<p>
                </div>
            </div>
        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-opensslencrypt.js"></script>
@endsection
