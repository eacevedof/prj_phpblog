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
            El sonido dura 7 segundos por lo tanto la alarma debería ser mayor a este tiempo de caso contrario
            una reproducción se omitirá
        </p>
    </div>
    @verbatim
    <div class="card-body">
        <form id="form-alarmclock">
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
                <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                    <label>Horas:</label>
                    <input type="number" class="form-control" min="0" max="300" maxlength="3"
                           ref="hh"
                           :disabled="isstarted"
                           v-model="hh"
                           v-on:change="hh_onchange"
                    />
                </div>
                <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                    <label>Minutos:</label>
                    <input type="number" class="form-control" min="0" max="59" maxlength="2"
                           :disabled="isstarted"
                           v-model="mm"
                           v-on:change="mm_onchange"
                    />
                </div>
                <div class="col-4 col-sm-3 col-md-2 col-xl-1">
                    <label>Segundos:</label>
                    <input type="number" class="form-control" min="0" max="59" maxlength="2"
                           :disabled="isstarted"
                           v-model="ss"
                           v-on:change="ss_onchange"
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
                        <img v-if="isstarted" src="/assets/images/loading-bw.gif" width="25" height="25"/>
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

                <div v-if="isstarted" class="col-4 col-sm-3 col-md-2 col-lg-2 col-xl-1 ml-lg-3">
                    <button type="button" class="btn btn-warning mt-4"
                            v-on:click="stop"
                    >
                        {{btnstop}}
                        <i class="fa fa-power-off"></i>
                    </button>
                </div>

                <div v-if="isstarted" class="col-4 col-sm-2 col-md-2 col-lg-2 col-xl-1">
                    <button type="button" class="btn btn-dark mt-4"
                            v-on:click="restart"
                    >
                        {{btnrestart}}
                        <i class="fa fa-repeat"></i>
                    </button>
                </div>
            </div>

            <audio ref="audio" controls class="d-none">
                <source type="audio/mp3" src="https://resources.theframework.es/eduardoaf.com/20201212/124331-alarm-sound-001.mp3" />
            </audio>

        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-alarmclock.js"></script>
@endsection
