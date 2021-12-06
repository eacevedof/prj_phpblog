@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])
@section("canonical",$canonical ?? "")

@section("container")
<div class="card opn-card" xmlns="http://www.w3.org/1999/html">
    <div class="card-header">
        <h1 class="card-title mt-2">{{$seo["description"]}}</h1>
    </div>
    @verbatim
    <div class="card-body">
        <form @submit="on_submit" id="form-formatsql" class="row g-3">
            <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                <label title="Nombre de la tabla a incluir en la consulta"><b>Tabla:*</b></label>
                <input type="text" class="form-control" max="100" required
                       ref="table"
                       :disabled="issending"
                       v-model="table"
                       @focus="$event.target.select()"
                />
            </div>
            <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                <label title="Lista de campos separados por ,"><b>Campos:*</b></label>
                <input type="text" class="form-control" max="5000" required
                       ref="fields"
                       :disabled="issending"
                       v-model="fields"
                       @focus="$event.target.select()"
                />
            </div>
            <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                <label><b>Separador de columna:*</b></label>
                <select v-model="colsep" class="form-control" required>
                    <option value="tab">Tabulación</option>
                    <option value="blank">Espacio</option>
                    <option value="comma">,</option>
                    <option value="semicolon">;</option>
                    <option value="hash">#</option>
                    <option value="pipe">|</option>
                    <option value="other">Otro (json, php, python ...)</option>
                </select>
            </div>
            <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                <label><b>Origen de datos:*</b></label>
                <select v-model="from" class="form-control" required>
                    <option value="csv">CSV</option>
                    <option value="json">Json</option>
                    <option value="php-array">Array PHP</option>
                    <option value="python-list">Lista de Python</option>
                </select>
            </div>
            <div class="col-4 col-sm-3 col-md-3 col-xl-2">
                <label><b>Tipo de consulta:*</b></label>
                <select v-model="to" class="form-control" required>
                    <option value="insert">INSERT INTO</option>
                    <option value="update">UPDATE</option>
                </select>
            </div>

            <div class="col-10">
                <label>Datos estructurados:*</label>
                <textarea class="form-control" maxlength="1000000" rows="10" required
                          style="font-family: 'Courier New'; font-size: smaller; border:1px solid #00B7FF!important;"
                       :disabled="issending"
                       v-model="rawdata"
                ></textarea>
            </div>
            <!-- boton -->
            <div class="col-1">
                <button id="btn-formatsql" class="btn btn-dark mt-4" :disabled="issending" >
                    {{btnsend}}
                    <img v-if="issending" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div v-if="rawdata" class="col-1 pl-4">
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
<script type="module" src="/js/open/service/vue-tosql.js"></script>
@endsection
