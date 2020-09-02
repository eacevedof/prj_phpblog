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
import Posts from "./components/restrict/post/Posts.vue";
import PostInsert from "./components/restrict/post/PostInsert.vue";
import PostUpdate from "./components/restrict/post/PostUpdate.vue";

Vue.component('posts', Posts);
Vue.component('postinsert', PostInsert);
Vue.component('postupdate', PostUpdate);

const app = new Vue({
    el: '#app',
});
