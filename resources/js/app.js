require('./bootstrap');

require("/assets/plugins/@mdi/font/css/materialdesignicons.min.css");
require("/assets/plugins/ti-icons/css/themify-icons.css");
require("/assets/plugins/perfect-scrollbar/perfect-scrollbar.css");

require("/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js");
require("/assets/js/off-canvas.js");
require("/assets/js/hoverable-collapse.js");
require("/assets/js/misc.js");
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Vue from 'vue';

import { BIconLayoutTextWindowReverse, BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Install BootstrapVue
Vue.use(BootstrapVue)

function loggedIn() {
    return localStorage.getItem('token');
}

import VueRouter from 'vue-router';
import routes from './routes/routes';
Vue.use(VueRouter);
let router = new VueRouter(routes);

router.beforeEach((to, from, next) => {
    document.title = 'Admin Dashboard | ' + to.meta.page_title;
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // Auth Routes, check if logged in
        if (!loggedIn()) {
            // if not, redirect to login page.
            next({
                path: '/backend/login',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        // User, check if logged in
        if (loggedIn()) {
            next({
                // if not, redirect to home page.
                path: '/backend',
                query: { redirect: to.fullPath }
            })
        } else {
            next()
        }
    } else {
        next()
    }
})

//form validation
import { Form } from 'vform';
window.Form = Form;


/*Start of Progress Bar*/
import VueProgressBar from 'vue-progressbar';
const options = {
    color: '#0276f8',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};
Vue.use(VueProgressBar, options)
    /*End of Progress Bar*/

/*Sweet alert start*/
import Swal from "sweetalert2";
window.swal = Swal;
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 5000,
    background: '#fafafa',
});

Vue.mixin({
    methods: {
        // Check server response and show it
        serverResponse(data) {
            if (data.result == 'success') {
                Toast.fire({
                    type: 'success',
                    title: data.message //Success message from server
                })
                this.$Progress.finish();
                Fire.$emit('AfterCreate'); //Fire an reload event

            } else {
                swal.fire(
                    'Error!',
                    data.message, //Error message from server
                    'error'
                )
                this.$Progress.fail(); //End the progress bar
            }
        }
    }
});

window.Toast = Toast;
/*End of sweet alert*/

/*Upper case Filter*/
Vue.filter('upText', function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

/*Moment JS to format Date*/
import moment from 'moment'; //format date in vue
Vue.filter('myDate', function(created) {
    return moment(created).format('Do MMMM  YYYY'); // April 7th 2019,(h:mm:ss a) 3:34:44 pm
});
Vue.filter('myDayDate', function(created) {
    return moment(created).format('ddd, D-MMM-YYYY'); // April 7th 2019,(h:mm:ss a) 3:34:44 pm
});

/*Start of Custom Event Listner Vue - Fires an event after a change*/
let Fire = new Vue();
window.Fire = Fire;

// Add a response interceptor
window.axios.interceptors.response.use(
    function(response) {
        // Do something with response data
        return response;
    },
    function(error) {
        // Do something with response error
        if (
            error.response.status === 401 &&
            error.response.data.message === "Unauthenticated."
        ) {
            localStorage.removeItem("token")
            location.href = "/backend/login";
        }
        return Promise.reject(error);
    }
);
/*Gate for Vue ACL in frontend*/
import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);
/*End of ACL authontication*/
/*Laravel Vue Pagination Starts*/
Vue.component('pagination', require('laravel-vue-pagination'));
/*End of Laravel vue pagination*/


const app = new Vue({
    el: '#app',
    router,
    data: {
        search: ''
    },
    methods: {
        searchit: _.debounce(() => {
            Fire.$emit('searching');
        }, 1000)
    }
});