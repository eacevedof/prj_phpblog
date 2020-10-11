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
                <button class="delete" aria-label="close" v-on:click="modal().closeit()"></button>
            </header>
            <section class="modal-card-body">
                <div class="columns is-mobile">
                    <div class="column is-one-third">
                        <label class="label">Idioma origen</label>
                        <div class="control">
                            <div class="select is-multiple">
                                <select id="sel-folders" v-model="config.selsource" class="form-control" required>
                                    <option v-for="(lang, i) in config.sources" :value="lang" :key="i">{{lang}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="column is-one-third field">
                        <label class="label">Idiomas destino</label>
                        <div class="control">
                            <div class="select is-multiple">
                                <select id="sel-folders" multiple size="2" v-model="config.seltargets" class="form-control" required>
                                    <option v-for="(lang, i) in config.targets" :value="lang" :key="i">{{lang}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success">Guardar</button>
                <button class="button" v-on:click="modal().closeit()">Cancel</button>
            </footer>
        </div>
    </div>
</div>
@endverbatim
