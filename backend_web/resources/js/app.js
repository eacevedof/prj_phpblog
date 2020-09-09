require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
import PostIndex from "./components/restrict/post/PostIndex.vue";
import PostInsert from "./components/restrict/post/PostInsert.vue";
import PostUpdate from "./components/restrict/post/PostUpdate.vue";

import UploadIndex from "./components/restrict/upload/UploadIndex";
import UploadInsert from "./components/restrict/upload/UploadInsert";

Vue.component('postindex', PostIndex);
Vue.component('postinsert', PostInsert);
Vue.component('postupdate', PostUpdate);

Vue.component('uploadindex', UploadIndex);
Vue.component('uploadinsert', UploadInsert);

const app = new Vue({
    el: '#app',
});
