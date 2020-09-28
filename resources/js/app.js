import App from './components/App.vue';
import Vue from 'vue';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue';

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

new Vue({
    components: {
        App
    }
}).$mount('#app');
