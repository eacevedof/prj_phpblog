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
            <div class="col-1">
                <label>Horas:</label>
                <input type="number" class="form-control" min="0" max="300"
                       ref="hh"
                       :disabled="isstarted"
                       v-model="hh"
                />
            </div>
            <div class="col-1">
                <label>Minutos:</label>
                <input type="number" class="form-control" min="0" max="59"
                       :disabled="isstarted"
                       v-model="mm"
                />
            </div>
            <div class="col-1">
                <label>Segundos:</label>
                <input type="number" class="form-control" min="0" max="59"
                       :disabled="isstarted"
                       v-model="ss"
                />
            </div>
            <!-- botones -->
            <div class="col-1">
                <button type="button"  class="btn btn-info mt-4"
                        :disabled="isstarted"
                        v-on:click="start"
                >
                    {{btnstart}}
                    <img v-if="isstarted" src="/assets/images/loading-bw.gif" width="25" height="25"/>
                </button>
            </div>
            <div v-if="isstarted" class="col-1 pl-4">
                <button type="button" class="btn btn-dark mt-4"
                        :disabled="isstarted"
                        v-on:click="reset"
                >
                    <i class="fa fa-clock"></i>
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
