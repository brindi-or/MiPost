import './bootstrap';
import { createApp } from 'vue';
// import Login from './components/auth/Login.vue';
import App from './App.vue';
import router from './router/index';
import { createPinia } from 'pinia';
import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// Add the icons you want to use to the library
library.add(fas)

const pinia = createPinia();

createApp(App)
    .use(router)
    .component('font-awesome-icon', FontAwesomeIcon)
    .use(pinia)
    .mount('#app');


