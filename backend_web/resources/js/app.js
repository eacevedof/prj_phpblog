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

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const arcomps = [
    {name:"posts-component", path:"./components/post/Posts.vue"},
    {name:"postinsert-component", path:"./components/post/PostInsert.vue"},
]

//arcomps.forEach( comp => Vue.component(comp.name, require(comp.path)))

import Posts from "./components/post/Posts.vue";
import PostInsert from "./components/post/PostInsert.vue";

Vue.component('posts', Posts);
Vue.component('postinsert', PostInsert);

const app = new Vue({
    el: '#app',
});
