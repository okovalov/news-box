
import Vue from "vue";
import _ from "lodash";
import axios from "axios";
import Buefy from "buefy";
import 'buefy/dist/buefy.css'

window.Vue = require('vue');

Vue.use(Buefy);

window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

const files = require.context('./components/', true, /\.vue$/i);

files.keys().map(key => {
    // const boo = key.split('/').pop().split('.')[0]
    // console.log('key!', key, boo)
    return Vue.component(key.split('/').pop().split('.')[0], files(key).default)

});

const app = new Vue({
    el: '#app'
});
