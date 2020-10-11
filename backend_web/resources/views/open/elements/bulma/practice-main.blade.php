@verbatim
<div id="div-practice-main" class="column is-11">
    <div class="content is-medium">
        <h3 class="title is-3 has-text-centered">
            ¯\_(ツ)_/¯
            <button v-if="ianswered>0" class="button is-success" v-on:click="restart">Reiniciar</button>
        </h3>
        <div v-if="isfinished" class="box has-text-centered">
            <div class="control">
                <button class="button is-link" v-on:click="start">Empezar exámen</button>
            </div>
        </div>
        <div v-if="!isfinished" class="box">
            <h4 class="title is-3">const</h4>
            <article class="message is-primary">
                <span class="icon has-text-primary">
                    <i class="fab fa-js"></i>
                </span>
                <div class="message-body">
                    Block-scoped. Cannot be re-assigned. Not immutable.
                    <input  type="text" class="input is-primary" v-model="question.q" placeholder="tu respuesta">
                    <br/><br/>
                    <pre><code>text</code></pre>
                </div>
                <footer class="modal-card-foot">
                    <button class="button is-success" v-on:click="save()">Guardar</button>
                </footer>
            </article>
        </div>

        <div v-if="isfinished && ianswered>0" class="box">
            <h4 class="title is-3">const</h4>
            <article class="message is-primary">
                <span class="icon has-text-primary">
                    <i class="fab fa-js"></i>
                </span>
                <div class="message-body">
                    Block-scoped. Cannot be re-assigned. Not immutable.
                    <input  type="text" class="input is-primary" v-model="question.q" placeholder="tu respuesta">
                    <br/><br/>
                    <pre><code>text</code></pre>
                </div>
                <footer class="modal-card-foot">
                    <button class="button is-success" v-on:click="save()">Guardar</button>
                </footer>
            </article>
        </div>
    </div>
</div>
@endverbatim
