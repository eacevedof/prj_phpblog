@verbatim
<div id="div-practice-main" class="column is-11">
    <div class="content is-medium">
        <h3 class="title is-3">¯\_(ツ)_/¯</h3>
        <div class="box">
            <h4 class="title is-3">const</h4>
            <article class="message is-primary">
                <span class="icon has-text-primary">
                    <i class="fab fa-js"></i>
                </span>
                <div class="message-body">
                    Block-scoped. Cannot be re-assigned. Not immutable.
                    <input  type="text" class="input is-primary" v-model="question.q" placeholder="tu respuesta">
                    <pre><code class="language-javascript">const test = "test";</code></pre>
                </div>
                <footer class="modal-card-foot">
                    <button class="button is-success" v-on:click="modal().save()">Guardar</button>
                    <button class="button" v-on:click="modal().close()">Cancel</button>
                </footer>
            </article>
        </div>
    </div>
</div>
@endverbatim
