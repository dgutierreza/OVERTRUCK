
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
/** VUE FORM */
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
/** END VUE FORM */

/** VUE SWEET ALERT2 */
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Toast = Toast;
/** END VUE SWEET ALERT2 */

/** VUE ROUTER */
import VueRouter from 'vue-router';
Vue.use(VueRouter)
/** END VUE ROUTER */

/** VUE PROGRESS BAR */
import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '4px',
  })
/** END VUE PROGRESS BAR */  


/** VUE ROUTER LINKS */
let routes = [
    { path: '/user/:id',name:'user', component: require('./users/User-detail.vue'),props: true},
    { path: '/tab-user-data',name:'TabUserdata', component: require('./users/TabUserdata.vue')},
    { path: '/list-user', component: require('./users/Users.vue')},
    { path: '/list-areas', component: require('./areas/Areas.vue') },
    { path: '/list-areasroles', component: require('./roles/AreasRoles.vue') },
    { path: '*', component: require('./others/NotFound.vue') }
  ]
const router = new VueRouter({
	mode: 'history',
    routes // short for `routes: routes`
  })
/** END VUE ROUTER LINKS */
window.Fire =  new Vue();
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    router,
    methods:{
      firstUpperCase(string){
        return string.charAt(0).toUpperCase() + string.slice(1);
                },
    }
});
