@extends("open.open-layout")

@section("pagetitle",$seo["title"])
@section("pagedescription",$seo["description"])
@section("pagekeywords",$seo["keywords"])

@section("container")
    <div class="card opn-card" xmlns="http://www.w3.org/1999/html">
        <div class="card-header">
            <h2 class="card-title mt-2">{{$seo["description"]}}</h2>
            <p>
                <b>Nota:</b>

            </p>
        </div>
        @verbatim
            <div class="card-body">
                <form id="form-ohmslaw">
                    <div class="row d-flex justify-content-xl-center">
                        <div class="col-12">
                            <pre class="alert-info p-3"><b>{{strhh}}</b>:<b>{{strmm}}</b>:<b>{{strss}}</b> <span v-if="seconds && !isstarted">{{seconds}} seg.</span> <span v-if="isstarted">{{hhmmss}}</span></pre>
                            <div v-if="isstarted" class="progress">
                                <div class="progress-bar progress-bar-striped bg-warning progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                     :style="{width: percent}"
                                >
                                    <span style="color:black; font-weight: bolder">Tiempo restante {{seconds}} seg.</span>
                                </div>
                            </div>
                        </div>
                        <!-- inputs -->
                        <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                            <label>V:</label>
                            <input type="number" class="form-control" min="0" max="300" maxlength="3"
                                   ref="v"
                                   :disabled="isstarted"
                                   v-model="v"
                                   v-on:change="hh_onchange"
                                   v-on:focus="$event.target.select()"
                            />
                        </div>
                        <div class="col-1 col-sm-1 col-md-1 col-xl-1 pt-4 m-0">
                            =
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                            <label>I:</label>
                            <input type="number" class="form-control" min="0" max="59" maxlength="2"
                                   :disabled="isstarted"
                                   v-model="i"
                                   v-on:change="mm_onchange"
                                   v-on:focus="$event.target.select()"
                            />
                        </div>
                        <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                            <label>R:</label>
                            <input type="number" class="form-control" min="0" max="59" maxlength="2"
                                   :disabled="isstarted"
                                   v-model="r"
                                   v-on:change="ss_onchange"
                                   v-on:focus="$event.target.select()"
                            />
                        </div>
                    </div>
                    <!-- botones -->
                    <div class="row d-flex justify-content-xl-center">
                        <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                            <button type="button"  class="btn btn-info mt-4"
                                    :disabled="isstarted || seconds<1"
                                    v-on:click="start"
                            >
                                {{btnstart}}
                                <i v-if="!isstarted" class="fa fa-play-circle"></i>
                                <span v-if="isstarted" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            </button>
                        </div>

                        <div v-if="!isstarted && (hh>0 || mm>0 || ss>0)" class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
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
    <script type="module" src="/js/open/service/vue-ohmslaw.js"></script>
@endsection
