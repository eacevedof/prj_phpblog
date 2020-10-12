@verbatim
<div id="div-practice-main" class="column is-11">
    <div class="content is-medium">
        <h3 class="title is-3 has-text-centered">
            <button v-if="!isfinished && iquestion>1 && iquestions>0" class="button is-success" v-on:click="restart">Reiniciar</button>
        </h3>
        <div v-if="isfinished && iquestions>0" class="box has-text-centered">
            <div class="control">
                <button class="button is-link" v-on:click="start">Empezar</button>
            </div>
        </div>
        <div v-if="!iquestions" class="has-text-centered">
            <div class="notification is-warning">
                ¯\_(ツ)_/¯<br/><br/>
                Este tema no tiene configurada ninguna pregunta<br/><br/>
                <a href="/idiomas" class="button is-black">Volver al temario</a>
            </div>
        </div>

        <div v-show="!isfinished" class="box">
            <h4 class="title is-6">Q: {{iquestion}}/ {{iquestions}}</h4>
            <article class="message is-primary mb-2">
                <span class="icon has-text-primary">
                    {{langsource}}
                </span>
                <div class="message-body p-3 mb-2">
                    <p><b>{{strquestion}}</b></p>
                    <label>Translate into: <b>{{langtarget}}</b></label>
                    <input  type="text" ref="answer" class="input is-primary" v-model="stranswer" placeholder="tu respuesta" autofocus />
                </div>
                <p class="p-3"><i class="fab fa-comment"></i> {{stranswer}}</p>
                <p v-if="expanswer" class="p-3">{{expanswer}}</p>
            </article>
            <div class="control has-text-right">
                <button class="button is-success" v-on:click="save">{{btnnext}}</button>
            </div>
        </div>

        <!-- resumen -->
        <div v-if="isfinished && answers.length>0">
            <h4 class="title is-5">Resumen:</h4>
            <pre class="is-size-7 p-1">
Total: {{iquestions}}
correctas: 0, incorrectas: 0
            </pre>
        </div>
        <div v-if="isfinished" v-for="answer in answers" class="box">
            <article class="notification is-warning">
                <p>
                    <b>q: {{answer.id}}</b><br/>
                    <b>La pregunta:</b><br/> {{answer.question}}<br/>
                    <b>Tu respuesta:</b><br/> {{answer.answer}}<br/>
                    <b>La respuesta correcta:</b><br/> {{answer.expected}}<br/>
                </p>
            </article>
        </div>
    </div>
</div>
@endverbatim
