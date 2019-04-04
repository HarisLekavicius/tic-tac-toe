
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();
window.axios = require('axios');
Vue.config.devtools = true;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.prototype.$eventHub = new Vue();
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('tic-tac-toe-table', require('./components/TicTacToeTable.vue'));
Vue.component('clear-button', require('./components/button.vue'));
Vue.component('current-player', require('./components/currentPlayer.vue'));
Vue.component('game-log', require('./components/gameLog.vue'));

// import {store} from './components/vuex/store.js'

const app = new Vue({
    el: '#app',
    // store
});


