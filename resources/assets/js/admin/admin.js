import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import AnimatedVue from 'animated-vue';
import VeeValidate from 'vee-validate';
import AwesomeNotifications from 'vue-awesome-notifications';
import { sync } from 'vuex-router-sync';
import routes from './routes';
import store from './store';
import axios from 'axios';

import 'animate.css/animate.css';

import Auth from './plugins/Auth.js';

Vue.use(VueRouter);
Vue.use(Auth);
Vue.use(AnimatedVue);
Vue.use(VeeValidate);
Vue.use(AwesomeNotifications, {	position: 'bottom-right' });


// axios.defaults.headers.common['Authorization'] = 'Bearer ' + Auth.getToken();
axios.interceptors.response.use( response => {
    	return response;
  	}, error => {
		if( error.response.status === 500 ) {
			Vue.prototype.$awn.alert('Whoops, something went wrong');
		}
    	return Promise.reject(error);
  	});

// Routing logic
var router = new VueRouter({
	routes: routes,
	mode: 'hash',
	linkExactActiveClass: 'active',
	scrollBehavior: function (to, from, savedPosition) {
		return savedPosition || { x: 0, y: 0 }
	}
});

// Some middleware to help us ensure the user is authenticated.
router.beforeEach((to, from, next) => {
	if ( to.matched.some(record => record.meta.requiresAuth) && ! router.app.$auth.isAuthenticated() ) {
		next({
		  path: '/login',
		  // query: { redirect: to.fullPath }
		});
	} else {
		next();
	}
});

sync(store, router);

const app = new Vue({
	el: '#app',
	router,
	store
});