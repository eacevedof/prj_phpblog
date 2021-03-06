@verbatim
<div id="div-practice-main" class="column is-11">
    <div v-if="isloading" class="has-text-centered is-warning">
        <div class="box button is-warning is-loading">Loading</div>
    </div>
    <div v-if="!isloading" class="content is-medium">
        <h3 class="title is-3 has-text-centered">
            <button v-if="!isfinished && iquestion>1 && iquestions>0" class="button is-success" v-on:click="restart">Reiniciar</button>
        </h3>
        <div v-if="isfinished && iquestions>0" class="box has-text-centered">
            <div class="control">
                <p>
                    You have configured: <b>{{iquestions}}</b> questions out of a total of <b>{{itotal}}</b><br/>
                    <b>{{config.israndom?"In random mode":""}}</b><br/>
                    Source language: <b>{{get_source_lang}}</b><br/>
                    Target language: <b>{{get_target_lang}}</b>
                </p>
                <button class="button is-link" v-on:click="start">Empezar</button>
            </div>
        </div>
        <div v-if="!iquestions" class="has-text-centered">
            <div class="notification is-warning">
                ¯\_(ツ)_/¯<br/><br/>
                No se han encontrado preguntas para esta configuración<br/>
                Traducir de: <b>{{get_source_lang}}</b> a: <b>{{get_target_lang}}</b><br/><br/>
                <a href="/idiomas" class="button is-black">Volver al temario</a>
            </div>
        </div>

        <div v-show="!isfinished" class="box">
            <h4 class="title is-6">Q: {{iquestion}}/ {{iquestions}} of {{itotal}}</h4>
            <article class="message is-primary mb-2">
                <span class="icon has-text-primary">
                    {{langsource}}
                </span>
                <div class="message-body p-3 mb-2">
                    <p><b>{{strquestion}}</b></p>
                    <label>Translate into: <b>{{langtarget}}</b></label>
                    <input type="text" class="input is-primary" placeholder="tu respuesta" autofocus
                            ref="answer"
                            v-model="stranswer"
                            v-on:keyup.enter="save"
                            />
                </div>
                <p v-if="errorword" class="p-3 tag is-danger is-medium">{{errorword}}</p><br/>
                <p class="p-3 tag is-warning is-medium"><b>TR:</b>&nbsp;{{stranswer}}</p><br/>
                <p v-if="expanswer" class="p-3 tag is-info is-medium"><b>RC:</b>&nbsp;{{expanswer}}</p>
            </article>
            <div class="control has-text-right">
                <button class="button is-warning" v-on:click="skip">{{btnskip}}</button>
                <button class="button is-success" v-on:click="save">{{btnnext}}</button>
            </div>
        </div>

        <!-- resumen -->
        <div v-if="isfinished && answers.length>0">
            <h4 class="title is-5">Resumen:</h4>
            <pre class="is-size-7 p-1">
Total: {{iquestions}}
correctas: {{iok}}, incorrectas: {{inok}}, saltadas: {{iskipped}}
            </pre>
        </div>
        <div v-if="isfinished"  v-for="answer in answers" class="box">
            <div class="notification is-warning">
                <p class="is-size-6">
                    <b>Pregunta {{answer.id}}:</b> {{answer.question}}<br/>
                    <b>Tu respuesta:</b><br/>&nbsp;&nbsp;{{answer.answer}}<br/>
                    <b>La respuesta correcta:</b><br/>&nbsp;&nbsp;{{answer.expected}}
                </p>
                <p class="has-text-right is-size-6">
                    <b>{{answer.status}}</b>
                </p>
            </div>
        </div>
    </div>
</div>
@endverbatim
