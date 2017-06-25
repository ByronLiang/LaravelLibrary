import Vue from 'vue'
import App from './App.vue'
import bootstrap from './config/bootstrap'

window.Vue = new Vue({
    ...App,
    ...bootstrap
})
.$mount('#app');
