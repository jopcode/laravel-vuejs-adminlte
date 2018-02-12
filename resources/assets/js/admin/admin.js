import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
import AnimatedVue from 'animated-vue';
import VeeValidate from 'vee-validate';
import AwesomeNotifications from 'vue-awesome-notifications';
import store from './store';
import Auth from './plugins/Auth.js';

import 'animate.css/animate.css';

Vue.use(VueRouter);
Vue.use(Auth);
Vue.use(AnimatedVue);
Vue.use(VeeValidate);
Vue.use(AwesomeNotifications, {	position: 'bottom-right' });


require('./config/interceptors');
require('./config/guards');

import router from './config/router';


const app = new Vue({
	el: '#app',
	router,
	store
});