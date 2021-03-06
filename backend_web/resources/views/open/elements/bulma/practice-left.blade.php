@verbatim
<div id="div-practice-left" class="column is-1">
    <aside class="is-medium menu">
        <ul class="menu-list">
            <li class="is-right">
                <button v-on:click="on_config" class="is-active"><i class="fas fa-cogs"></i> Config</button>
            </li>
        </ul>
    </aside>
    <div id="div-modal" class="modal">
        <div class="modal-background"></div>
        <div class="modal-card">
            <header class="modal-card-head">
                <p class="modal-card-title">Configuración</p>
                <button class="delete" aria-label="close" v-on:click="modal().close()"></button>
            </header>
            <section class="modal-card-body">
                <div class="columns is-mobile">
                    <div class="column is-4">
                        <label class="label">Idioma origen</label>
                        <div class="control">
                            <div class="select is-multiple">
                                <select id="sel-source" v-model="config.selsource" class="form-control" required>
                                    <option v-for="(lang, i) in config.sourcelangs" :value="lang.id" :key="i">
                                        {{lang.code_erp}}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4 field">
                        <label class="label">Idiomas destino</label>
                        <div class="control">
                            <div class="select is-multiple">
                                <select id="sel-seltargets" multiple size="2" v-model="config.seltargets" class="form-control" required>
                                    <option v-for="(lang, i) in config.targetlangs" :value="lang.id" :key="i">{{lang.code_erp}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column is-4 field">
                        <label class="label">Tiempo/preg</label>
                        <div class="control">
                            <input  type="number" class="input is-primary" v-model="config.time" max="30" placeholder="0 - 30 seg">
                        </div>
                    </div>
                </div>
                <div class="columns is-mobile">
                    <div class="column is-4">
                        <label class="label">Dificultad</label>
                        <div class="control">
                            <div class="select is-multiple">
                                <input type="range" class="input is-primary" v-model="config.level" min="1" max="2" placeholder="1 - 2">
                            </div>
                        </div>
                    </div>
                    <div class="column is-4 field">
                        <label class="label">Aleatorio</label>
                        <div class="control">
                            <label class="radio">
                                <input type="radio" v-model="config.israndom" value="true"/>Yes
                            </label>
                            <label class="radio">
                                <input type="radio" v-model="config.israndom" value="false"/>No
                            </label>
                        </div>
                    </div>
                    <div class="column is-4 field">
                        <label class="label">Tot. preguntas</label>
                        <div class="control">
                            <input  type="number" class="input is-primary" v-model="config.questions" min="1" max="100" placeholder="1 - 100">
                        </div>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success" v-on:click="modal().save()">Guardar</button>
                <button class="button" v-on:click="modal().close()">Cancel</button>
            </footer>
        </div>
    </div>
</div>
@endverbatim
