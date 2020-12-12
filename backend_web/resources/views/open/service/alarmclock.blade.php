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
        <form @submit="on_submit" id="form-alarmclock" class="row g-3">
            <div class="col-1">
                <label>Horas:</label>
                <input type="number" class="form-control" min="0" max="300"
                       :disabled="issending"
                       v-model="query"
                />
            </div>
            <div class="col-1">
                <label>Minutos:</label>
                <input type="number" class="form-control" min="0" max="59"
                       :disabled="issending"
                       v-model="query"
                />
            </div>
            <div class="col-1">
                <label>Segundos:</label>
                <input type="number" class="form-control" min="0" max="59"
                       :disabled="issending"
                       v-model="query"
                />
            </div>
            <!-- botones -->
            <div class="col-1">
                <button id="btn-alarmclock" class="btn btn-dark mt-4" :disabled="issending" >
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
            <!-- /botones-->
            <audio ref="audio-mp3" controls>
                <source type="audio/mp3" src="https://resources.theframework.es/eduardoaf.com/20201212/124331-alarm-sound-001.mp3" />
            </audio>

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
<script type="module" src="/js/open/service/vue-alarmclock.js"></script>
@endsection
