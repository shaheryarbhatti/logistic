require('./bootstrap');

import VueRouter from 'vue-router';
import router from './routes';
import Index from  "./Index";
import Vuex from 'vuex';
import ValidationErrors from "./shared/components/ValidationErrors";
import storeDefinition from "./store";



window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.use(Vuex);


Vue.component("v-errors", ValidationErrors);

const store = new Vuex.Store(storeDefinition);

window.axios.interceptors.response.use(
    response => {
        return response;
    },
    error => {
        if (401 === error.response.status) {
            store.dispatch("logout");
        }

        return Promise.reject(error);
    }
);



const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
      "index" : Index,
    },

    async beforeCreate(){
      this.$store.dispatch("loadStoredState");
      this.$store.dispatch("loadUser");
    },
});
