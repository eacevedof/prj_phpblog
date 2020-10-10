<div id="div-practice-left" class="column is-1">
    <aside class="is-medium menu">
        <ul class="menu-list">
            <li class="is-right">
                <button v-on:click="on_config()" class="is-active"><i class="fas fa-cogs"></i> Config</button>
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
            </section>
            <footer class="modal-card-foot">
                <button class="button is-success">Save changes</button>
                <button class="button">Cancel</button>
            </footer>
        </div>
    </div>
</div>
