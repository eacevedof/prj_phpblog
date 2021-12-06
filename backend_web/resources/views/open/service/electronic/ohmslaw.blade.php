@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])
@section("canonical",$canonical ?? "")

@section("container")
    <div class="card opn-card" xmlns="http://www.w3.org/1999/html">
        <div class="card-header">
            <h1 class="card-title mt-2">{{$seo["description"]}}</h1>
            <p>
                <img src="https://resources.theframework.es/eduardoaf.com/20210216/calculadora-ley-de-ohm.png" title="{{ $seo["description"] }}" alt="{{ $seo["description"] }}" class="img-fluid" />
            </p>
        </div>
        @verbatim
            <div class="card-body">
                <form id="form-ohmslaw">
                    <div class="row d-flex justify-content-xl-center">
                        <div class="col-12">
                            <pre class="alert-info p-3"><b>{{strhh}}</b>:<b>{{strmm}}</b>:<b>{{strss}}</b> <span v-if="seconds && !isstarted">{{seconds}} seg.</span> <span v-if="isstarted">{{hhmmss}}</span></pre>
                        </div>
                        <!-- inputs -->
                        <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                            <label>V:</label>
                            <input type="number" class="form-control" min="0" max="9999999" maxlength="3"
                                   ref="v"
                                   v-model="v"
                                   v-on:change="v_onchange"
                                   v-on:focus="$event.target.select()"
                            />
                        </div>
                        <div class="col-1 col-sm-1 col-md-1 col-xl-1 pt-4 m-0">
                            <b>=</b>
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                            <label>I:</label>
                            <input type="number" class="form-control" min="0" max="9999999" maxlength="2"
                                   v-model="i"
                                   v-on:change="i_onchange"
                                   v-on:focus="$event.target.select()"
                            />
                        </div>
                        <div class="col-1 col-sm-1 col-md-1 col-xl-1 pt-4 m-0">
                            <b>x</b>
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                            <label>R:</label>
                            <input type="number" class="form-control" min="0" max="9999999" maxlength="2"
                                   v-model="r"
                                   v-on:change="i_onchange"
                                   v-on:focus="$event.target.select()"
                            />
                        </div>
                    </div>
                    <!-- botones -->
                    <div class="row d-flex justify-content-xl-center">
                        <div v-if="(v>0 || i>0 || r>0)" class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                            <button type="button" class="btn btn-danger mt-4"
                                    v-on:click="clear"
                            >
                                Limpiar
                                <i class="fa fa-eraser"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    @endverbatim
    <script type="module" src="/js/open/service/electronic/vue-ohmslaw.js"></script>
@endsection
