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
        <form id="form-alarmclock" class="row g-3">
            <div class="col-12">
                <pre class="alert-info p-3"><b>{{strhh}}</b>:<b>{{strmm}}</b>:<b>{{strss}}</b></pre>
            </div>
            <div class="col-1">
                <label>Horas:</label>
                <input type="number" class="form-control" min="0" max="300" maxlength="3"
                       ref="hh"
                       :disabled="isstarted"
                       v-model="hh"
                       v-on:change="hh_onchange"
                />
            </div>
            <div class="col-1">
                <label>Minutos:</label>
                <input type="number" class="form-control" min="0" max="59" maxlength="2"
                       :disabled="isstarted"
                       v-model="mm"
                       v-on:change="mm_onchange"
                />
            </div>
            <div class="col-1">
                <label>Segundos:</label>
                <input type="number" class="form-control" min="0" max="59" maxlength="2"
                       :disabled="isstarted"
                       v-model="ss"
                       v-on:change="ss_onchange"
                />
            </div>

            <!-- botones -->
            <div class="col-2">
                <button type="button"  class="btn btn-info mt-4"
                        :disabled="isstarted"
                        v-on:click="start"
                >
                    {{btnstart}}
                    <i class="fa fa-play-circle"></i>
                    <img v-if="isstarted" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>

            <div class="col-2">
                <button type="button" class="btn btn-dark mt-4"
                        :disabled="isstarted"
                        v-on:click="reset"
                >
                    {{btnreset}}
                    <i class="fa fa-stop-circle"></i>
                    <img v-if="isstarted" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>

            <div class="col-2">
                <button type="button" class="btn btn-warning mt-4"
                        :disabled="isstarted"
                        v-on:click="stop"
                >
                    {{btnstop}}
                    <i class="fa fa-power-off"></i>
                    <img v-if="isstarted" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <!-- /botones-->
            <audio ref="audio-mp3" controls>
                <source type="audio/mp3" src="https://resources.theframework.es/eduardoaf.com/20201212/124331-alarm-sound-001.mp3" />
            </audio>

        </form>
    </div>
</div>
@endverbatim
<script type="module" src="/js/open/service/vue-alarmclock.js"></script>
@endsection
