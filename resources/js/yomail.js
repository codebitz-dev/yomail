import Vue from 'vue'
import App from './app.vue';

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import dayjs from 'dayjs';

import VueCodemirror from 'vue-codemirror'
import 'codemirror/lib/codemirror.css'
import 'codemirror/theme/base16-dark.css'
import 'codemirror/theme/base16-light.css'
Vue.use(VueCodemirror)

Vue.use(ElementUI);

Object.defineProperties(Vue.prototype, {
    $date: {
        get() {
            return dayjs
        }
    }
});


new Vue({
    render: h => h(App)
}).$mount('#app')
